<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public function showRegisterView(Request $request) {

    	return view("client_register");
    }
}
