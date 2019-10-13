<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Redirect;
use App\User;
use App\Orders;
use App\Visit;
use App\Outlet;
use \Carbon\Carbon;
use App\Collections;
use App\OutletZone;
use App\PromoterZone;
use App\Support\Collection;
use Illuminate\Http\Request;
use App\Price;
use App\UserPrice;

class PromotersController extends Controller
{
    
    public function showPromoters(Request $request){

    	$promoters = User::where("client_type","promoter")->orderBy("created_at","desc")->get();

    	$data = ["promoters" => $promoters];
    	return view("promoter.promoters",["name" => "Promoters"])->withData($data);
    }

    public function showAddPromoter(Request $request) {

    	return view("promoter.add",['name' => "Add Promoter"]);
    }


    public function getAllPromoters(Request $request) {
    	$promoters = User::orderBy("created_at","desc")->get();

    	return $this->successResponse($promoters);
    }

    public function deletePromoter(Request $request) {

        $promoter = User::find($request->id);

        if (isset($promoter)) {
            $promoter->delete();
        }



        return Redirect::back()->with("message","Promoter deleted successfully");

    }

    public function updateOutletLocation(Request $request) {
        $data = $request->validate([
            "outlet_id" => "required",
            "latitude" => "required",
            "longitude" => "required"
        ]);


        $outlet = Outlet::find($data["outlet_id"]);
        if(!isset($outlet)) {
            return $this->errorRessponse("outlet doesn't exist",403);
        }

        $outlet->logitude = $data["latitude"];
        $outlet->latitude = $data["longitude"];
        $outlet->save();


        return $this->successResponse(["message" => "outlet saved successfully"]);
    }


    /**
     * Get a promoters infomation
     * 
     * @param  Request $request 
     * @return view
     */
    public function getPromoter(Request $request ) {

        $activities = [];

        $month = request('month',(int)now()->format("m"));
        $year = request('year',(int)now()->format("Y"));
        $day = now()->format('d');



        $date = Carbon::createFromFormat("d-m-Y","$day-$month-$year");

        $mDate = isset($request->month) ? $date->endOfMonth() : now();

        $days = $this->getMonthDates($mDate);



        foreach ($days as $key => $day) {
            

            $data["orders"] = DB::table("orders")->where("promoter_id",$request->id)->whereDate("created_at",$day)->get()->sum("price");
            
            // $data["orders"] = DB::table("orders")->where("promoter_id",$request->id)->whereDate("created_at",$day)->get()->sum("price");

            $data["collections"] = DB::table("collections")->where("promoter_id",$request->id)->whereDate("created_at",$day)->sum("amount");

            $data["new_pins"] = DB::table("outlets")->where("promoter_id",$request->id)->whereDate("created_at",$day)->count();

            $data["visits"] = DB::table("visits")->where("promoter_id",$request->id)->whereDate("created_at",$day)->count();

            $data["duration"] = DB::table("day_sessions")->where("promoter_id",$request->id)->whereDate("created_at",$day)->first();

            $data["date"] = $day;

            array_push($activities, $data);
        }
        
        

        $stats = [
            "orders" => DB::table("orders")->where("promoter_id",$request->id)->whereMonth("created_at",$day)->sum("price"),
            "collections" => DB::table("collections")->where("promoter_id",$request->id)->whereMonth("created_at",$day)->sum("amount"),
            "visits" => DB::table("visits")->where("promoter_id",$request->id)->whereMonth("created_at",$day)->count(),
            "new_pins" => DB::table("outlets")->where("promoter_id",$request->id)->whereMonth("created_at",$day)->count()
        ];
        $promoter = User::find($request->id);
        $months = \Carbon\CarbonPeriod::create('2019-01-01', '1 month', '2019-12-01');

        return view("promoter.promoter")->withData(["activities" => $activities,"stats" => $stats,"months" => $months,"promoter" => $promoter]);

    }

    /**
     * Get the working days in the month
     * 
     * @return Carbon\Carbon
     */
    private function getMonthDates($date) {

        $end = $date;
        $start = $end->copy()->startOfMonth();


        $dates = [];
        while ($start->lte($end)) {
            if ($start->isWeekday()) {
                $dates[] = $start->copy();
            }
             $start->addDay();
        }

        return array_reverse($dates);

    }

    public function getPromotersOutlets(Request $request) {
        //some constratins will come here

        $outlet = PromoterZone::where("promoter_id",$request->promoter_id)->first();

        return isset($outlet) ? $this->successResponse($outlet->zones->take(20)) : [];
        
    }

    public function getAnOutletsDaysOrders(Request $request) {

        $orders = DB::table("orders")->where("promoter_id",Auth::user()->id)->whereDate("created_at",Carbon\Carbon::now())->get();


        return $this->successResponse($orders);

    }

    public function getAnOutletsDaysCollections(Request $request) {

        $collections = DB::table("collections")->where("promoter_id",Auth::user()->id)->whereDate("created_at",Carbon\Carbon::now())->get();

        return $this->successResponse($orders);


    }

    public function addOrders(Request $request) {

        $request->validate(["orders_json" => "required"]);

        $orders = json_decode($request->orders_json,true);

        foreach ($collections as $key => $orders) {
        
            Orders::create([
                "promoter_id" => "required",
                "outlet_id" => "required",
                "product_title" => "required",
                "quantity" => "required",
                "price" => "required"
            ]);
        }

        return $this->successResponse(["message" => "order(s) created successfully"]);

    }

    public function addCollections(Request $request) {

        $request->validate(["collections_json" => "required"]);

        $collections = json_decode($request->collections_json,true);

        foreach ($collections as $key => $collection) {
        
            Collections::create([
                "promoter_id" => "required",
                "outlet_id" => "required",
                "product_title" => "required",
                "quantity" => "required",
                "price" => "required"
            ]);
        }
        return $this->successResponse(["message" => "collection(s) created successfully"]);
    }

    public function getNewPromotersOutlets(Request $request) {

        $promoter = User::find($request->id);
        $newOutlets = Outlet::where("auditor_verified",false)->where("promoter_id",$request->id)->orderBy("created_at","desc")->get();

        $outlets = (new Collection($newOutlets))->paginate(10);

        $zones = OutletZone::orderBy("created_at","desc")->get();

        return view("outlet.outlet",["name" => "New Outlets by $promoter->name","isNew" => true])->withData(["outlets" => $outlets,"zones" => $zones]);

    }   


    public function showPromoterPrices($id) {

        $user = User::find($id);

        if (!$user) 
            return back();
    
        $userPrices = $user->userPrices;

        $prices = Price::all();

        return view('promoter.promoter_prices', compact('user', 'userPrices', 'prices'));

    }

    public function assignPrice(Request $request) {
 
        $this->validate($request, [
            'user_id' => 'required',
            'price_id' => 'required'
        ]); 

        if(UserPrice::where('price_id', $request->price_id)->where('user_id', $request->user_id)->exists())
            return back()->with('error', 'this price has already been assigned to this user');

        UserPrice::create([
            'user_id' => $request->user_id,
            'price_id' => $request->price_id,
        ]);

        return back()->with('status', 'Price successfully assigned');
    }



   
}
