<?php

namespace App\Http\Controllers;

use App\User;
use App\Outlet;
use Auth;
use DB;
use App\Price;
use App\OutletSession;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function getAllOutlets(Request $request) {

    	$outlet = Outlet::with(["promoter"])->orderBy("created_at","desc")->get();

    	return $this->successResponse($outlet);
    	
    }

    public function uploadImage (Request $request) {

        if ($request->hasFile("file")) {
            $image = $request->file('file');
            $extension = $request->file('file')->extension();
            $filename = now()->timestamp.$this->randomNumber(3).".png";

            $image->move(public_path('upload/images'),$filename);

        }else {
            return $this->errorResponse("Error uploading File",403);
        }

        return $this->successResponse(["data" => ["url" => $filename]]);

    }


    public function uploadResource(Request $request) {

    	if ($request->hasFile("file")) {
            $image = $request->file('file');
            $extension = $request->file('file')->extension();
            $filename = now()->timestamp.$this->randomNumber(3).".csv";

            $image->move(public_path('resource'),$filename);

        }else {
        	return $this->errorResponse("Error uploading File",403);
        }

    	return $this->successResponse(["data" => ["url" => $filename]]);
    }


    public function getClientStatistics(Request $requests) {


        $dailyStatistics = DB::table("outlet_sessions")->whereDate("created_at",\Carbon\Carbon::now())->count();

        $totalStatistics = OutletSession::where("promoter_id",Auth::user()->id)->count();

        $data = [
            ["title" => "Daily Statistics","value" => $dailyStatistics,"maxValue" => 10],
            ["title" => "Total Statistics","value" => $totalStatistics,"maxValue" => 200]
        ];


        return $this->successResponse($data);

    }

    public function getPrices(Request $request) {

        $user = User::find(Auth::user()->id);

        $prices = [];

        if ($user->is_consignment) {
            $prices = Price::where("price_group_id",39)->orderBy("created_at","desc")->get();
        }else {
            $prices = Price::orderBy("created_at","desc")->get();
        }


        return $this->successResponse($prices);

    }

    public function loadUserMapStat(Request $request) {

        $user = User::find($request->userId);

        $date = \Carbon\Carbon::parse($request->date);

        $collection = DB::table("collections")->where("promoter_id",$user->id)->whereDate("created_at",$date)->sum("amount");

        $orders = DB::table("orders")->where("promoter_id",$user->id)->whereDate("created_at",$date)->sum("price");

        $visits = DB::table("visits")->where("promoter_id",$user->id)->whereDate("created_at",$date)->count();
        // return $date;
        return $this->successResponse(["user" => $user,"collection" => $collection,"orders" => $orders,"visits" => $visits]);
    }
}
