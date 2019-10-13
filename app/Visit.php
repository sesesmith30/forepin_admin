<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visit extends Model
{
	use SoftDeletes;

    protected $fillable = ["outlet_id","promoter_id","next_appointment_date"];


    public function outlet () {
    	return $this->belongsTo(Outlet::class);
    }
}
