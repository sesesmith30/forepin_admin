<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Log;
use App\Outlet;
use Carbon\Carbon;
use App\OutletZone;
use App\DaySession;
use App\OutletSession;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    //
    protected $dailyOutletsVisit = 20;

    public function startDaySession(Request $request) {

    	$data = ["start_time" => \Carbon\Carbon::now()];
        $data["promoter_id"] = Auth::user()->id;

    	$dateSession = DB::table("day_sessions")->where("promoter_id",$data["promoter_id"])->whereDate("start_time",\Carbon\Carbon::now())->first(); 

        // Log::info($dateSession);

        //check if the session exist alreadyy
        //we give you the outlets 
        if (isset($dateSession)) {
            return  $this->successResponse(["outlets" => $this->getOutlets()] );
        }

        
        $data["outlets_to_visit"] = json_encode($this->getOutlets());
    	DaySession::create($data);
    	
        //maybe we will get the users routes here
    	return $this->successResponse(["outlets" => $data["outlets_to_visit"]]);

    }



    private function getOutlets() {

        //FETCHING FOR OUTLETS
        //we search for appointments
        //now we search for
        $outlets = [];

        $today = Carbon::now();
        //getting todays appointments
        $appointment = DB::table("appointments")->whereDate("day",$today)->where("promoter_id",Auth::user()->id)->first();

        $outlets = isset($appointment) ? json_decode($appointment->outlets,true) : [];


        //get the remainning outlets size after appointments
        $remainingOutletSize = $this->dailyOutletsVisit - sizeof($outlets);

        //if appointments didn't exaust dailyVisit limit
        //we get remaining outlets after appointments
        //we sorting this in order of last Visits
        if ($remainingOutletSize > 0) {

            $userZone = OutletZone::where("assigned_promoter",Auth::user()->id)->first();

            if (!isset($userZone)) {
                return $outlets;
            }

            $allOutlets = Outlet::where("zone_id",$userZone->id)->with(["visits"])->orderBy("created_at","asc")->get();


            $sortedRemainingOutlets = $allOutlets->sortBy( function ( $anOutlet ) {
                return sizeof($anOutlet->visits) > 0 ? $anOutlet->visits[0]->created_at : [];
            });

            $sortedRemainingOutlets = $sortedRemainingOutlets->take($remainingOutletSize);

            //now we push the remaining outlets from 
            foreach ($sortedRemainingOutlets->values()->all() as $key => $anOutlet) {
                array_push($outlets, $anOutlet);
            }
        }  

        return $outlets;
    }

    public function endDaySession(Request $request) {


        $dateSession = DB::table("day_sessions")->whereDate("start_time",\Carbon\Carbon::now())->first(); 

        if (isset($dateSession)) {
            
            $daySession->end_time = \Carbon\Carbon::now();

            $daySession->save();
        }
        

    	return $this->successResponse(["message" => "Day Ended Succefully"]);
    }


    public function getAPromotersDaysOutlets(Request $request) {

        $date = \Carbon\Carbon::createFromFormat("Y-m-d",$request->date);

        //this is a special case for when id is zero
        //we search for all the outlets
        
        if ($request->id == 0) {
            
            $daySession = DB::table("day_sessions")->whereDate("created_at",$date)->get();
            $myArr = [];
            foreach ($daySession as $key => $session) {
                foreach (json_decode($session->outlets_to_visit,true) as $key => $outlets) {
                    array_push($myArr, $outlets);
                }
            }
            return $myArr;
        }
        
        //this is when request id is specified and is not zero(0)
        $daySession = DB::table("day_sessions")->whereDate("created_at",$date)->where("promoter_id",$request->id)->first(); 

        if (isset($daySession)) {
            return $this->successResponse($daySession->outlets_to_visit);
        }

        return [];

    }

    public function reviewOutlet(Request $request,$id) {

    	$outlet = Outlet::find($id);

    	$data = $request->validate([
			"outlet_id" => "required",
			"shelf_pic_one_url" => "required",
			"shelf_pic_two_url" => "required",
			"product_order" => "required",
			"amount_collected" => "required",
			"representative_signature_url" => "required"
    	]);


    	$data["promoter_id"] = Auth::user()->id;
        $data["start_date"] = \Carbon\Carbon::now();

    	OutletSession::create($data);

    	return $this->successResponse(["message" => "done"]);
    }

}
