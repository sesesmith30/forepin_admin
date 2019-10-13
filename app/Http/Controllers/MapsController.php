<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapsController extends Controller
{
    

    public function showMaps(Request $request) {


    	return view("maps.map",["name" => "Live Maps"]);
    }

    public function showAuditorMaps(Request $request) {

    	return view("auditor.maps",["name" => "Live Maps"]);
    }
}
