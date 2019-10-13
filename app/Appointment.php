<?php

namespace App;

use App\User;
use App\Outlet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
	use SoftDeletes;
    
    protected $fillable = ["promoter_id","outlets","initiator_name","reason","day"];


    public function promoter() {
    	return $this->belongsTo(User::class,"promoter_id");
    }

}
