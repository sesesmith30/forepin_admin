<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("number/{number}","Controller@getNumber");

Route::post("image/upload","AppController@uploadImage");

Route::post("promoter/login","AuthController@loginClient");

Route::post("auditor/login","AuthController@loginAuditor");

Route::get("outlets","AppController@getAllOutlets");

Route::post("outlet/location/update","PromotersController@updateOutletLocation");

Route::get("promoter/{date}/outlets/{promoter_id}","PromotersController@getPromotersOutlets");

Route::get("prices","AppController@getPrices")->middleware("auth:api");

Route::post("promoter/pin/add","OutletController@addNewPin");

Route::post("promoter/pin/add/gson","OutletController@addNewPinGson");

Route::get("/promoter/{id}/session/{date}","SessionController@getAPromotersDaysOutlets")->where('date', '(.*)');

Route::post("/price/upload_csv","PricesController@uploadPriceViaCsv");

Route::get("/loadUserMapStat/{userId}/on/{date}","AppController@loadUserMapStat")->where('date', '(.*)');


Route::middleware(["auth:api"])->group(function (){

	Route::post("day/session/start","SessionController@startDaySession");
	
	Route::post("day/session/end","SessionController@endDaySession");

	Route::post("outlet/session/{id}","SessionController@reviewOutlet");

	Route::get("client/statistics","AppController@getClientStatistics");


	Route::post("auditor/pin/{outlet_id}/verify","OutletController@verifyPin");

	Route::get("/promoter/{date}/orders/{outlet_id}","PromotersController@getAnOutletsDaysOrders");

	Route::get("/promoter/{date}/orders/{outlet_id}","PromotersController@getAnOutletsDaysCollections");

	Route::post("/promoter/order/add","PromotersController@addOrders");

	Route::post("/promoter/collections/add","PromotersController@addCollections");

	Route::post("sales/store", "SalesController@storeSales");



	//upload Outlet Visit
	Route::post("/promoter/outlet/visit","OutletController@uploadOutletVisitDate");

});

Route::get("promoter","PromotersController@getAllPromoters");

