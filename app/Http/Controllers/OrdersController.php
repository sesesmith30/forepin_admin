<?php

namespace App\Http\Controllers;

use DB;
use Redirect;
use App\User;
use App\Orders;
use \Carbon\Carbon;
use App\Charts\OrdersCharts;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    

    public function showOrders( Request $request) {

    	$query = Orders::query();

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

        if ($request->has("promoter")) {
            if($request->promoter > 0)
                $query = $query->where("promoter_id",$request->promoter);
        }

        $orders = $query->with(["promoter","outlet"])->get();



        $dates = $this->getMonthDates($start, $end);

        // return $dates;

        $days = [];
        $chartOrders = [];

        $data = [];

        foreach ($dates as $key => $date) {
                
            $days[$key] = $date->format("jS");

            $ords = Orders::whereDate("created_at",$date)->get();


            if ($request->has('promoter') and $request->promoter > 0) {
                $ords = Orders::where('promoter_id', $request->promoter)->whereDate("created_at",$date)->get();
            }

            $sum =  0;
            
            foreach($ords as $ord) {

                $gsons = json_decode($ord->orders_gson, true);

                foreach($gsons as $gson)
                    $sum += ($gson['price'] * $gson['quantity']);

                // $priceCollection = collect(json_decode($order->orders_gson),true)->map(function($item,$key){
                //     return $item->price * $item->quantity;
                // });
            }

            // $chartOrders[$key] = $priceCollection->sum();
             $chartOrders[$key] = $sum;


        }


    	$chart = new OrdersCharts;
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

    	return view("order.orders",["name" => "Orders", "range" => $range])->withData(["orders" => $orders,"promoters" => $promoters,"chart" => $chart]);
    }


    public function deleteOrder(Request $request) {

    	$order = Orders::find($request->id);

    	if (isset($order)){
    		$order->delete();
    	}

    	return Redirect::back()->with("message","Order Deleted succesfully");
    }

    public function printOrder(Request $request) {

        $order = Orders::with(["promoter","outlet"])->find($request->id);

        return view("order.order_print")->withData(["order" => $order]);
    }

    public function showCosignmentOrders(Request $request) {

        $query = Orders::query();

        $query->orderBy("created_at","desc")->where("as_consignment",true);
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

        if ($request->has("promoter")) {
            if($request->promoter > 0)
                $query = $query->where("promoter_id",$request->promoter);
        }

        $orders = $query->with(["promoter","outlet"])->get();



        $dates = $this->getMonthDates($start, $end);

        $days = [];
        $chartOrders = [];

        foreach ($dates as $key => $date) {
            $days[$key] = $date->format("jS");

              $order = DB::table("orders")->where("as_consignment",true)->whereDate("created_at",$date)->value('orders_gson');

            if ($request->has('promoter') and $request->promoter > 0) {
                $order = DB::table("orders")->where('promoter_id', $request->promoter)->whereDate("created_at",$date)->value('orders_gson');
            }

            $priceCollection = collect(json_decode($order),true)->map(function($item,$key){
                return $item->price * $item->quantity;
            });

            $chartOrders[$key] = $priceCollection->sum();
        }


        $chart = new OrdersCharts;
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

        return view("order.consignment_orders",["name" => "Orders", "range" => $range])->withData(["orders" => $orders,"promoters" => $promoters,"chart" => $chart]);

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
