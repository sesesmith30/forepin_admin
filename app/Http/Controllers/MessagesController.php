<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessagesController extends Controller
{
    
    public function showMessagesView(Request $request) {


    	return view("message.message",["name" => "Messages"]);
    }

    public function showAuditorMessageView(Request $request) {

    	return view("auditor.message",["name" => "Messages"]);


    }
}
