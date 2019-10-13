<?php

namespace App\Http\Controllers\OutletUser;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    protected $redirectTo = '/outletuser/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('outlet_user.auth:outlet_user');
    }

    /**
     * Show the OutletUser dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('outletuser.home');
    }

}