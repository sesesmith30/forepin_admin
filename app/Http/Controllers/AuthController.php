<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use App\User;
use App\Notifications\RegistrationMail;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //

    public function loginClient(Request $request){

    	$request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $credentials = request(['username', 'password']);
        // $credentials = array_add($credentials,"client_type","promoter");

        if (!Auth::attempt($credentials)) {

        	return $this->errorResponse("Wrong username or password",401);

        }
        
        $user = $request->user();

        $token = $user->createToken("myPersonaAccessClient")->accessToken;

        return $this->successResponse(["user" => $user,"access_token" => $token]);

    }

    public function loginAuditor(Request $request) {

        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $credentials = request(['username','passowrd']);
        $credentials = array_add($credentials,"client_type","auditor");

        if (!Auth::attempt($credentials)) {

            return $this->errorResponse("Wrong username or password",401);

        }

        $user = $request->user();

        $token = $user->createToken("myPersonaAccessClient")->accessToken;

        return $this->successResponse(["user" => $user,"access_token" => $token]);

    }

    //register a promoter
    public function addPromoter(Request $request) {

    	$data = $request->validate([
    		"email" => "required",
    		"name" => "required",
            "phone_number" => "required",
            "client_type" => "required"
    	]);


        // return $request->all();

    	$username = str_random(6);
    	$password = $this->randomNumber(6);

    	$data["username"] = $username;
    	$data["password"] = bcrypt($password);
        $data["is_consignment"] = $request->is_consignment == "on" ? true : false;

    	$user = User::create($data);
    	
    	$user->notify(new RegistrationMail(["username" => $username,"password" => $password]));

    	return Redirect::back()->with("message","Promoter Added Succesfully");

    }
}
