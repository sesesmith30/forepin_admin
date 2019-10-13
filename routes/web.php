<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::any('{query}', function() { 
  	return "forepin under maintenance";
 })->where('query', '.*');




// Route::get('/', function () {
// 	return "forepin under maintenance";
//     // return redirect("admin/home");
// });


// Route::get("/admin/client/register","AdminController@showRegisterView");

Route::get("try","Controller@try");

Route::post("/admin/resource/upload/{id}","AppController@uploadResource");


Route::middleware(["auth:admin"])->group(function() {

	
	Route::get("/admin/home","HomeController@index")->name("admin.home");
	Route::get("/admin/auditors","AuditorController@showAuditors");



	Route::get("/admin/promoters","PromotersController@showPromoters");
	Route::get("/admin/promoter/add","PromotersController@showAddPromoter");
	Route::post("/admin/promoter/add","AuthController@addPromoter");
	Route::get("/admin/promoter/{id}/show","PromotersController@getPromoter");
	Route::get("/admin/promoter/{id}/delete","PromotersController@deletePromoter");
	Route::get("/admin/promoter/{id}/outlet/new/","PromotersController@getNewPromotersOutlets");
	Route::get("/admin/promoter/{id}/prices", "PromotersController@showPromoterPrices");



	Route::get("/admin/cash_vans","CashVanController@showCashVans");
	Route::get("/admin/cash_van/add","CashVanController@showAddCashVan");
	Route::post("/admin/cash_van/add","CashVanController@addCashVan");
	Route::get("/admin/cash_van/{id}/prices", "PromotersController@showPromoterPrices");



	// Route::get("/admin/cash_vans","CashVanController@showCashVans");
	// Route::get("/admin/cash_van/add","CashVanController@showAddCashVan");
	// Route::post("/admin/cash_van/add","CashVanController@addCashVan");


	Route::get("/admin/maps","MapsController@showMaps");

	Route::get("/admin/messages","MessagesController@showMessagesView");


	Route::get("/admin/prices","PricesController@showPrices");
	Route::get("/admin/price/group/{group_id}","PricesController@showPricesByGroup");
	Route::post("/admin/price/group/add","PricesController@addPriceGroup");
	Route::get("/admin/price/group/{id}/delete","PricesController@deletePriceGroup");
	Route::get("/admin/price/{id}/delete","PricesController@deletePrice");
	Route::get("/admin/price/{id}/add_to_push_product","PricesController@addToPushProduct");
	Route::get("/admin/price/{id}/remove_from_push_product","PricesController@removeFromPushProduct");
	Route::post("/admin/price/add","PricesController@addPrice");
	Route::post("/admin/price/upload_csv","PricesController@uploadPriceViaCsv");


	Route::get("/admin/orders","OrdersController@showOrders");
	Route::get("/admin/orders/consignment","OrdersController@showCosignmentOrders");
	Route::get("/admin/order/{id}/delete","OrdersController@deleteOrder");
	Route::get("/admin/order/{id}/print","OrdersController@printOrder");


	Route::get("/admin/collections","CollectionController@showCollections");
	Route::get("/admin/collection/{id}/delete","CollectionController@deleteCollection");
	Route::get("/admin/collection/{id}/print","CollectionController@printCollection");

	Route::get("/admin/returns","ReturnsController@showReturns");



	Route::get("/admin/appointments","AppointmentController@showAllTargets");
	Route::get("/admin/appointment/add","AppointmentController@showAddTarget");
	Route::post("/admin/appointment/add","AppointmentController@addTarget");
	Route::get("/admin/appointment/{id}/delete","AppointmentController@deleteTarget");

	Route::get("/admin/outlets","OutletController@showOutlets");
	Route::get("/admin/outlets/new","OutletController@showNewOutlets");
	Route::get("/admin/outlets/new/{id}/print","OutletController@printNewOutlet");
	Route::get("/admin/outlet/{id}/details","OutletController@showAnOutletDetails");
	Route::get("/admin/outlet/add","OutletController@showAddOutletView");
	Route::get("/admin/outlet/csv","OutletController@showUploadCsv");
	Route::get("/admin/outlet/{id}/delete","OutletController@deleteOutlet");
	Route::get("/admin/outlet/zone/{id}/delete","OutletController@deleteOutletZone");
	Route::post("/admin/outlet/assign_promoter","OutletController@assignOutletZoneToPromoter");
	Route::post("/admin/outlet/zone/add","OutletController@addOutletZone");
	Route::post("/admin/outlet/{id}/zone/assign","OutletController@assignZoneToOutlet");
	Route::get("/admin/outlet/{zone}/show","OutletController@showOutletByZone");
	Route::post("/admin/outlet/csv","OutletController@uploadCsvFile");
	Route::post("/admin/outlet/add","OutletController@addOutlet");


	Route::post("/admin/user-price/assign", "PromotersController@assignPrice")->name('price.assign');






	Route::get("/admin/auditor/dashboard","AuditorController@showAuditorDashboard")->name("auditor.dashboard");
	Route::get("/admin/auditor/maps","MapsController@showAuditorMaps");
	Route::get("/admin/auditor/messages","MessagesController@showAuditorMessageView");


});

