<?php

namespace App\Http\Controllers;

use DB;
use Log;
use Auth;
use Redirect;
use App\User;
use App\Visit;
use App\Orders;
use App\Outlet;
use App\Returns;
use Dompdf\Dompdf;
use \Carbon\Carbon;
use App\OutletZone;
use App\Collections;
use App\Support\Collection;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    
    public function showOutlets(Request $request){

    	$unAssignedOutlets = [
            "id" => 0,
            "name" => "null",
            "locality" => "",
            "assigned_promoter" => null,
            "outlets" => DB::table("outlets")->whereNull("zone_id")->orWhere("zone_id",0)->get()
        ];
        
        $outlets = OutletZone::orderBy("created_at","desc")->with(["outlets","promoter"])->get()
        ->toArray();
        array_push($outlets, $unAssignedOutlets);


        $promoters = User::orderBy("created_at","desc")->get();

        // return $outlets; 
    	$outlets = (new Collection($outlets))->paginate(10);

    	return view("outlet.outlet_group",["name" => "Outlet Zones"])->withData(["outlets" => $outlets,"promoters" => $promoters]);

    }

    public function showOutletByZone(Request $request) {

        $currentZone = null;

        if ($request->zone == "null") {
            $name = "Unassigned Outlets";
            $outlets = DB::table("outlets")->whereNull("zone_id")->orWhere("zone_id",0)->orderBy("created_at","desc")->get();
        }else {

            $outlets = OutletZone::where("name",$request->zone)->orderBy("created_at","desc")->first()->outlets;
            $name = $request->zone. " Outlets";
            $currentZone = OutletZone::where("name",$request->zone)->first();
        }

        $zones = OutletZone::orderBy("created_at","desc")->get();


        // return $currentZone;

        $outlets = (new Collection($outlets))->paginate(10);

        return view("outlet.outlet",["name" => $name])->withData(["outlets" => $outlets,"zones" => $zones,"currentZone" => $currentZone]);

    }


    public function assignZoneToOutlet(Request $request) {

        $data = $request->validate([
            "zone_id" => "required",
        ]);

        $outlet = Outlet::find($request->id);
        $outlet->zone_id = $data["zone_id"];
        $outlet->save();


        return Redirect::back()->with("message","Outlet Assigned Successfully");

    }   

    public function assignOutletZoneToPromoter(Request $request) {

        $data = $request->validate([
            "promoter_id" => "required",
            "outlet_zone_id" => "required"
        ]);

        $outletZone = OutletZone::find($data["outlet_zone_id"]);
        $outletZone->assigned_promoter = $data["promoter_id"];
        $outletZone->save();


        return Redirect::back()->with("message","Promoter assigned Successfully");

    }


    public function deleteOutlet(Request $request) {

        $outlet = Outlet::find($request->id);

        if (isset($outlet)) {
            $outlet->delete();
        }

        return Redirect::back()->with("message","Outlet Deleted Successfully");
    }

    public function deleteOutletZone(Request $request) {

        $outletZone = OutletZone::find($request->id);

        if (isset($outletZone)) {
            $outletZone->delete();
        }

        return Redirect::back()->with("message","Outlet Zone Deleted Successfully");

    }

    public function addOutletZone(Request $request) {

        $data = $request->validate([
            "name" => "required"
        ]);
        $data["locality"] = "locality";


        OutletZone::create($data);

        return Redirect::back()->with("message","Outlet Zone Added Successfully");

    }


    public function showAddOutletView(Request $request) {

    	return view("outlet.add",["name" => "Add Outlet"]);

    }

    public function showUploadCsv(Request $request) {

    	return view("outlet.csv",["name" => "Upload CSV"] );
    }

    public function addOutlet(Request $request) {

    	$data = $request->validate([
    		"outlet_name" => "required",
			"contact_person_name" => "required",
			"position" => "required",
			"mobile_number" => "required",
			"locality" => "required",
			"sub_locality" => "required",
			"landmark" => "required",
			"streetname" => "required",
			"latitude" => "required",
			"logitude" => "required",
		]);

		$outlet = Outlet::create($data);


		if( $request->is('api/*')){

			return $this->successResponse(["message" => "Outlet Added"]);

	    }else{
	    	return Redirect::back()->with("message","Outlet Added Successfully");

	    }

    }


    public function uploadOutletVisitDate(Request $request ) {

        // $data = $request->validate([
        //     "collections_gson" => "required",
        //     "orders_gson" => "required",
        //     "returns_gson" => "required",
        //     "outlet_id" => "required",
        // ]);
        // 
        $data = $request->all();

        Log::info("data is". json_encode($data));


        $user = User::find(Auth::user()->id);
        

        //save orders
        $ordersArray = json_decode($data["orders_gson"],true);
        $price = collect($ordersArray)->map(function($item,$key){
            return $item['price'] * $item['quantity'];
        });


        $order = Orders::create([
            "promoter_id" => Auth::user()->id,
            "outlet_id" => $data["outlet_id"],
            "orders_gson" => $data["orders_gson"],
            "price" => $price->sum(),
            "is_sorted" => Auth::user()->client_type == "cash_van",
            "as_consigment" => $request->order_as_consignment == 1 ? true : false
        ]);


        //save collections
        $collectionArray = json_decode($data["collections_gson"],true);

        if (isset($collectionArray["mode"])) {
            Collection::create([
                "promoter_id" => Auth::user()->id,
                "outlet_id" => $collectionArray["outletId"],
                "mode" => $collectionArray["mode"],
                "image_url" => $collectionArray["image"],
                "amount" => $collectionArray["amount"],
                "order_id" => $user->client_type == "cash_van" ? $order->id : null,
            ]);
        }
        

        $outlet = Outlet::find($data["outlet_id"]);
        $promoterName = Auth::user()->name;
        $totalPrice = $price->sum();
        $dateInitiated = $outlet->created_at;

        //send Sms to the outlet's phone number
        //only if an order was made
        if (sizeof($ordersArray) > 0) {
            $httpController = HttpController::getInstance();

            $random = $this->randomNumber(6);
            $random = "$random"+$order->id;

            $str = "Order of amount GHC $totalPrice has been made by $promoterName of FORWING GH. Date Intiated: $dateInitiated. Ref Number: $random Thank you";

            Log::info("str is ".$str);

            // $httpController->sendSms($str,$outlet->mobile_number);
        }
        


        //save returns
        $returnArray = json_decode($data["returns_gson"],true);

        Returns::create([
            "promoter_id" => Auth::user()->id,
            "outlet_id" => $data["outlet_id"],
            "reason" => "fish reason",
            "returns_gson" => $data["returns_gson"],
            "price" => 0.00
        ]);

        // foreach ($returnArray as $key => $returns) {
        //     Returns::create([
        //         "price_id" => $returns["id"],
        //         "promoter_id" => Auth::user()->id,
        //         "outlet_id" => $returns["outlet_id"],
        //         "product_title" => $returns["itemDescription"],
        //         "quantity" => $returns["quantity"],
        //         "price" => $returns["price"],
        //         "reason" => "fish reason"
        //     ]);
        // }

        Visit::create([
            "promoter_id" => Auth::user()->id,
            "outlet_id" => $data["outlet_id"]
        ]);

        return $this->successResponse(["message" => "Visit Done Successfully"]);

    }


    public function showNewOutlets(Request $request) {

        $newOutlets = Outlet::where("auditor_verified",false)->with(["recruiter"])->orderBy("created_at","desc")->get();

        $outlets = (new Collection($newOutlets))->paginate(10);

        // return $outlets;

        $zones = OutletZone::orderBy("created_at","desc")->get();

        return view("outlet.outlet",["name" => "New Outlets","isNew" => true])->withData(["outlets" => $outlets,"zones" => $zones]);
    }


    public function printNewOutlet(Request $request) {


        $view = view("print.registration_1");

        return $view;
    }

    public function verifyPin(Request $request,$outletId) {

    	$outlet = Outlet::find($outletId);
    	$outlet->verify_auditor_id = Auth::user()->id;
    	$outlet->auditor_verified = true;

    	$outlet->save();


    	return $this->successResponse(["message" => "Pin Verified Successfully"]);

    }

    public function addNewPin(Request $request) {

    	$data = $request->validate([
    		"outlet_name" => "required",
			"contact_person_name" => "required",
			"position" => "required",
			"mobile_number" => "required",
			"locality" => "required",
			"sub_locality" => "required",
			"landmark" => "required",
			"streetname" => "required",
			"latitude" => "required",
			"logitude" => "required",

    	]);

        $data["zone"] = "null";

    	$outlet = Outlet::create($data);

    	return $outlet;

    }


    public function addNewPinGson(Request $request) {

        $data = $request->validate([
            "gson" => "string"
        ]);

        Log::info($data);

        $outletData = json_decode($data["gson"],true);

        $outlet = Outlet::create($outletData);

        return $outlet;
    }


    public function showAnOutletDetails(Request $request) {

        $outlet = Outlet::where("id",$request->id)->with(["visits","orders","collections","returns"])->first();

        $month = request('month',(int)now()->format("m"));
        $year = request('year',(int)now()->format("Y"));
        $day = now()->format('d');

        $date = Carbon::createFromFormat("d-m-Y","$day-$month-$year");

        $mDate = isset($request->month) ? $date->endOfMonth() : now();

        $days = $this->getMonthDates( $mDate );

        $activities = [];

        foreach ($days as $key => $day) {

            $data["orders"] = DB::table("orders")->where("outlet_id",$outlet->id)->whereDate("created_at",$day)->get()->sum("price");

            $data["collections"] = DB::table("collections")->where("outlet_id",$outlet->id)->whereDate("created_at",$day)->sum("amount");

            $data["returns"] = DB::table("returns")->where("outlet_id",$outlet->id)->whereDate("created_at",$day)->sum("price");

            $data["visits"] = DB::table("visits")->where("outlet_id",$outlet->id)->whereDate("created_at",$day)->count();

            $data["date"] = $day;

            array_push($activities, $data);
        }

        
        $stats = [
            "orders" => DB::table("orders")->where("outlet_id",$outlet->id)->whereMonth("created_at",$date)->sum("price"),
            "collections" => DB::table("collections")->where("outlet_id",$outlet->id)->whereMonth("created_at",$date)->sum("amount"),
            "visits" => DB::table("visits")->where("outlet_id",$outlet->id)->whereMonth("created_at",$date)->count(),
            "returns" => DB::table("returns")->where("outlet_id",$outlet->id)->whereMonth("created_at",$date)->count(),
        ];

        $months = \Carbon\CarbonPeriod::create('2019-01-01', '1 month', '2019-12-01');

        // return $outlet;
        return view("outlet.outlet_details",["name" => $outlet->outlet_name])->withData(["outlet" => $outlet,"activities" => $activities,"stats" => $stats, "months" => $months]);
    }

    public function uploadCsvFile(Request $request) {
        // return $request->all();
    	if ($request->hasFile("file")) {
            $image = $request->file('file');
            $extension = $request->file('file')->extension();
            $filename = now()->timestamp.$this->randomNumber(3).".csv";

            $image->move(public_path('resource'),$filename);



            $file = public_path("resource/$filename");

	        $csvArray = $this->csvToArray($file);

	        $myArr = [];

	        foreach ($csvArray as $key => $data) {
	            
	            if ( is_numeric($data[0]) && isset($data[1]) && is_string($data[1])){
	                array_push($myArr, $data);
	            }

	        }
            

            // return $myArr;

	        foreach ($myArr as $key => $data) {
	        	$outlet = Outlet::where("outlet_name",$data[1])->first();
	        	if (isset($outlet)) {
	        		continue;
	        	}

        		$vals = [
        			"outlet_name" => $data[1],
					"contact_person_name" => $data[2],
					"position" => "NA",
					"mobile_number" => $data[3],
					"locality" => $data[4],
					"sub_locality" => $data[5],
					"landmark" => $data[6],
					"streetname" => $data[7],
					"latitude" => $data[10],
					"logitude" => $data[11],
				];
                $vals["zone_id"] = $request->zone_id;

				Outlet::create($vals);
	        }

			return Redirect::back()->with("message","File Uploaded Successfully");

        }else {
        	return Redirect::back()->withErrors(["error uploading file "]);
        }

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

}
