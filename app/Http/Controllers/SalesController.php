<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;

class SalesController extends Controller
{
    public function showSales(Request $r) {

    }


    public function storeSales(Request $r) {
    	$this->validate($r, [
    		'sales_gson' => 'required',
    		'outlet_id' => 'required',
    		'user_id' => 'required'
    	]);


    	Sale::create([
    		'user_id' => $r->user_id,
    		'outlet_id' => $r->outlet_id,
    		'sales_gson' => $r->sales_gson
    	]);

    	return $this->successResponse(["message" => "Sales(s) added successfully"]);
    } 
}
