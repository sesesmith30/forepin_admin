<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HttpController
{
    
    private static $instance = null;

    private function __construct(){
    }

    public static function getInstance() {
    	if (self::$instance == null ){
    		self::$instance = new HttpController();
    	}
    	return self::$instance;
    }

    public function sendSMS($message,$to) {

    	$client = new Client();
    	$response = $client->request("GET","https://apps.mnotify.net/smsapi",[
    		"query" => [
    			"key" => env("MNOTIFY_SMS_KEY"),
    			"to" => $to,
    			"msg" => $message,
    			"sender_id" => "FOREWINGH"
    		]
    	]);

    	return $response->getBody()->getContents();
    }
}
