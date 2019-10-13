<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Orders;
use \Carbon\Carbon;
use App\Collections;
use App\Charts\CollectionChart;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    
    public function showCollections(Request $request) {

    	$query = Collections::query();

        $query->orderBy("created_at","desc");

        $start = null;
        $end = null;

        if (!$request->has("daterange") && $request->daterange == null) {
            $end = Carbon::today();
            $start = Carbon::today()->subDays(10);
            
        }else {

            $range = explode("-", str_replace(" ", "", $request->daterange));
       
            $start = Carbon::createFromFormat('m/d/Y', $range[0]);
            $end = Carbon::createFromFormat('m/d/Y', $range[1]);        
            // return Carbon::today()->format('m/d/Y');
        }

        $query = $query->whereBetween(DB::raw('DATE(created_at)'), [$start, $end]);

        if ($request->has("promoter") && $request->promoter > 0) {
            $query = $query->where("promoter_id",$request->promoter);
        }

        $collections = $query->with(["promoter","outlet"])->get();

        $dates = $this->getMonthDates($start, $end);
        $days = [];
        $chartOrders = [];

        foreach ($dates as $key => $date) {
        	$days[$key] = $date->format("jS");
            $totalCollections = DB::table("collections")->whereDate("created_at",$date)->sum("amount");

             if ($request->has('promoter') and $request->promoter > 0) {
                $totalCollections = DB::table("collections")->where('promoter_id', $request->promoter)->whereDate("created_at",$date)->sum("amount");
            }

        	$chartOrders[$key] = $totalCollections;
        }


    	$chart = new CollectionChart;
        $chart->labels($days);

        $chart->dataset('Orders', 'line', $chartOrders)->options([
            "fill" => false,
            "borderWidth" => 3,
            "borderColor" => "#28a745",
            "backgroundColor" => "#FFF"
        ]);

        $promoters = User::orderBy("updated_at","desc")->get();

        $str = Carbon::today()->subDays(10)->format('m/d/Y'). " - ". Carbon::today()->format('m/d/Y');

        $range = $request->has("daterange") ? $request->daterange : $str;

    	return view("collection.collections",["name" => "Orders", "range" => $range])->withData(["collections" => $collections,"promoters" => $promoters,"chart" => $chart]);

    }

    private function getMonthDates($start, $end) {

        $dates = [];
        
         while ($start->lte($end)) {
            if ($start->isWeekday()) {
                $dates[] = $start->copy();
            }
             $start->addDay();
        }


        return $dates;

    }

}
