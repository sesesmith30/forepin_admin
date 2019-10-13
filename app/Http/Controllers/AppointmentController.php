<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use App\User;
use App\Outlet;
use Carbon\Carbon;
use App\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
     public function showAllTargets(Request $request) {

    	$targets = Appointment::orderBy("created_at","desc")->with(["promoter"])->paginate(20);

    	return view("targets.targets",["name" => "Tartgets"])->withData(["targets" => $targets]);
    }

    public function showAddTarget(Request $request) {

    	$outlets = Outlet::orderBy("created_at","desc")->get();
    	$promoters = User::orderBy("created_at","desc")->get();

    	return view("targets.add_target",["name" => "Add Target"])->withData(["outlets" => $outlets,"promoters" => $promoters]);
    }

    public function addTarget(Request $request) {

    	$data = $request->validate([
    		"outlets" => "required",
    		"promoter_id" => "required",
    		"reason" => "required",
    		"day" => "required"
    	]);


    	$outlets = [];

    	foreach ($data["outlets"] as $outletId) {
    		$outlet = Outlet::find($outletId);
    		array_push($outlets, $outlet);
    	}

    	$data["outlets"] = json_encode($outlets);
    	$data["initiator_name"] = Auth::user()->name;
    	$data["day"] = Carbon::createFromFormat("m/d/Y",$request->day);

    	Appointment::create($data);

        return Redirect::back()->with("message","Target Added Successfully");

    }

    public function deleteTarget(Request $request) {

    	$target = Appointment::find($request->id);

    	if (isset($target) ) {
    		$target->delete();
    	}


        return Redirect::back()->with("message","Target Deleted Successfully");

    }
}
