<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use App\User;
use Illuminate\Http\Request;

class CashVanController extends Controller
{
    

    public function showCashVans(Request $request){

    	$cashVans = User::where("client_type","cash_van")->orderBy("created_at","desc")->get();


    	// return $cashVans;
    	return view("cash_van.cash_vans", ["name" => "Cash Vans"])->withData(["cashVans" => $cashVans]);
    	
    }

    public function showAddCashVan(Request $request) {


    	return view("cash_van.add",['name' => "Add Cash Van"]);
    }

}
