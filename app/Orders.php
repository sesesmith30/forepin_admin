<?php

namespace App;

use App\User;
use App\Price;
use App\Outlet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{

    use SoftDeletes;


	protected $fillable = ["promoter_id","outlet_id","orders_gson","price","is_sorted","as_consignment"];


    public function promoter() {

    	return $this->belongsTo(User::class,"promoter_id");

    }

    public function pricing() {
    	return $this->belongsTo(Price::class,"price_id");
    }

    public function outlet() {

    	return $this->belongsTo(Outlet::class);
    }
}
