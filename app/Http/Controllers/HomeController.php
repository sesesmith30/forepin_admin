<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Outlet;
use App\Orders;
use App\Charts\DailyResults;
use App\OutletSession;
use \Carbon\Carbon;
use App\OutletSessionSkip;
use Illuminate\Http\Request;
use App\Appointment;
use App\Returns;
use App\PriceGroup;

class HomeController extends Controller
{
    
    public function index(Request $request){


        $roleId = auth("admin")->user()->roles[0]->pivot->role_id;
        if ($roleId == 2) {
            return redirect()->route("auditor.dashboard");
        }   
    	$promoters = User::count();
    	$outlets = Outlet::count();
    	$outletSessions = OutletSession::count();
    	$outletSessionSkips = OutletSessionSkip::count();
        $totalOrders = Orders::count();
        $totalReturns = Returns::count();
        $priceGroups = PriceGroup::count();
        $appointments = Appointment::whereRaw('DATE(day) >= '.Carbon::today()->format('Y-m-d'))->count();

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


        $dates = $this->getMonthDates($start, $end);
        $orders = [];
        $collections = [];
        $returns = [];
        $days = [];


        foreach ($dates as $key => $date) {
           //lets get all orders, collections, sales on this day
           $orders[$key] = DB::table("orders")->whereDate("created_at",$date)->sum("price");
           $collections[$key] = DB::table("collections")->whereDate("created_at",$date)->sum("amount");
           $returns[$key] = DB::table("returns")->whereDate("created_at",$date)->sum("price");
           $days[$key] = $date->format("jS");
        }


        // return $d;
        //creating charts
        $chart = new DailyResults;
        $chart->labels($days);

        $chart->dataset('Orders', 'bar', $orders)->options([
            "fill" => false,
            "borderWidth" => 3,
            "borderColor" => "#28a745",
            "backgroundColor" => "#FFF"
        ]);


        $chart->dataset('Collections', 'bar', $collections)->options([
            "fill" => true,
            "borderWidth" => 3,
            "borderColor" => "#6f42c1",
            "backgroundColor" => "#FFF"
        ]);

        $chart->dataset('Returns', 'bar', $returns)->options([
            "fill" => false,
            "borderWidth" => 3,
            "borderColor" => "#ffc107",
            "backgroundColor" => "#FFF"
        ]);


    	$data["promoters"] = $promoters;
    	$data["outlets"] = $outlets;
    	$data["outletSessions"] = $outletSessions;
    	$data["outletSessionSkips"] = $outletSessionSkips;
        $data["orders"] = $totalOrders;
        $data["returns"] = $totalReturns;
        $data["appointments"] = $appointments;
        $data["chart"] = $chart;

        $str = Carbon::today()->subDays(10)->format('m/d/Y'). " - ". Carbon::today()->format('m/d/Y');
        $range = $request->has("daterange") ? $request->daterange : $str;

    	
     	return view("home",["name" => "Dashboard", "range" => $range])->withData($data);
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
