<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
	use SoftDeletes;

    protected $fillable = ['user_id', 'outlet_id', 'sales_gson'];

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function outlet() {
    	return $this->belongsTo(Outlet::class);
    }
}
