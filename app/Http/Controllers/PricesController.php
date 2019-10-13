<?php

namespace App\Http\Controllers;

use Redirect;
use App\Price;
use App\PriceGroup;
use Illuminate\Http\Request;

class PricesController extends Controller
{
    
    public function showPrices(Request $request) {

    	$priceGroups = PriceGroup::orderby("created_at","desc")->with(["prices"])->get();

    	return view("price.price_group",["name" => "Price groups"])->withData(["groups" => $priceGroups]);
    }

    public function showPricesByGroup(Request $request) {

        $priceGroup = PriceGroup::find($request->group_id);
        $prices = Price::where("price_group_id",$request->group_id)->orderby("created_at","desc")->get();

        return view("price.prices",["name" => "Prices"])->withData(["prices" => $prices,"priceGroup" => $priceGroup]);

    }

    public function deletePrice(Request $request) {

    	$price = Price::find($request->id);

    	if (isset($price)){
    		$price->delete();
    	}


    	return Redirect::back()->with("message","Price deleted succesfully");
    }

    public function addPriceGroup(Request $request) {
        $data = $request->validate([
            "group_name" => "required"
        ]);

        PriceGroup::create($data);


        return Redirect::back()->with("message","price group added succesfully");
    }

    public function addPrice(Request $request) {

    	$data = $request->validate([
    		"item_code" => "required",
    		"supplier" => "required",
    		"item_description" => "required",
    		"price" => "required",
            "price_group_id" => "required"
    	]);


    	Price::create($data);


    	return Redirect::back()->with("message","Price added succesfully");

    }

    public function deletePriceGroup(Request $request) {


        $priceGroup = PriceGroup::find($request->id);

        if(isset($priceGroup)) {
            $priceGroup->delete();



            //we delete all associted prooducts too
            $price = Price::where("price_group_id",$priceGroup->id)->delete();
            
        }


        



        return Redirect::back()->with("message","Done deleting price Group");


    }

    public function addToPushProduct(Request $request) {

        $price = Price::find($request->id);

        if (isset($price)) {
            $price->is_push_product = true;
            $price->save();
        }

        return Redirect::back()->with("message","added to push Products succesfully");
    
    }

    public function removeFromPushProduct(Request $request) {

        $price = Price::find($request->id);

        if (isset($price)) {
            $price->is_push_product = false;
            $price->save();
        }

        return Redirect::back()->with("message","removed from push Products succesfully");


    }

    public function uploadPriceViaCsv(Request $request){

        if ($request->hasFile("file")) {
            $image = $request->file('file');
            $extension = $request->file('file')->extension();
            $filename = now()->timestamp.$this->randomNumber(3).".csv";

            $image->move(public_path('resource'),$filename);


            $file = public_path("resource/$filename");

            $csvArray = $this->csvToArray($file);

            $myArr = [];


            foreach ($csvArray as $key => $data) {
                
                if ( isset($data[4]) && is_numeric($data[4]) ){
                    // array_push($myArr, $data);
                    $priceGroup = PriceGroup::where("group_name",$data[0])->first();
                    if (!isset($priceGroup)) {
                        $priceGroup = PriceGroup::create([
                            "group_name" => $data[0]
                        ]);
                    }
                    $price = Price::where("item_code",$data[1])->first();
                    if (!isset($price)) {
                        Price::create([
                            "price_group_id" => $priceGroup->id,
                            "item_code" => $data[1],
                            "supplier" => $data[2],
                            "item_description" => mb_strtolower($data[3]),
                            "price" => $data[4]
                        ]);
                    }    
                }
            }

            return Redirect::back()->with("message","Done Uploading with CSV");

        }else {

            echo "error";

        }
    }
}
