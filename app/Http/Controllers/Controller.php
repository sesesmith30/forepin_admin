<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

     public function successResponse($data) {
    	return response($data,200);
    }

    public function errorResponse($message,$errorCode){

    	return response([ "message" => $message] ,$errorCode);
    }

    public function randomNumber($length) {
        $result = '';
        for($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }
        return $result;
    }

    public function try(Request $request) {

        $file = public_path('Book1.csv');

        $csvArray = $this->csvToArray($file);

        $myArr = [];

        foreach ($csvArray as $key => $data) {
            
            if ( is_numeric($data[0]) && isset($data[1]) && is_string($data[1])){
                array_push($myArr, $data);
            }

        }

        return $myArr;

    }


    function csvToArray($filename = '', $delimiter = ',') {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                array_push($data, $row);
            }
            fclose($handle);
        }

    return $data;
    
    }

    public function getNumber(Request $request,$number) {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://expresspaygh.com/client_api/billpay_service.php',[
            'form_params' => [
                'request' => 'bill_inquiry',
                'merchant_service_srvrtid' => '6419383364489',
                'payacct' => $number,
                'api' => '4.0'
            ]]);

        return json_decode($response->getBody(),true);





    }

    
}
