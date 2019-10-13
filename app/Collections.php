<?php

namespace App;

use App\User;
use App\Price;
use App\Outlet;
use App\Orders;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collections extends Model
{

    use SoftDeletes;

	protected $fillable = ["promoter_id","outlet_id","order_id","amount","image_url"];
    

     public function promoter() {

    	return $this->belongsTo(User::class,"promoter_id");

    }

    public function order() {
        return $this->belongsTo(Orders::class,"order_id");
    }

    public function price() {

    	return $this->belongsTo(Price::class);
    }

    public function outlet() {

    	return $this->belongsTo(Outlet::class);
    }
}
