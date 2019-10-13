<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use App\User;
use Illuminate\Http\Request;

class AuditorController extends Controller
{
    
    public function showAuditors(Request $request) {

    	$auditor = User::where("client_type","auditors")->orderBy("created_at","desc")->get();

    	$data = ["auditor" => $auditor];

    	return view("auditor.auditor",["name" => "Auditors"])->withData($data);
    }

    public function showAuditorDashboard() {

    	return view("auditor.dashboard", ["name" => "Auditor Dashboard" ]);

    }
}
