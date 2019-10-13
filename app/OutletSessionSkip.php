<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OutletSessionSkip extends Model
{
	use SoftDeletes;
    
    protected $fillable = ["promoter_id","outlet_id","day_session_id","reason"];
}
