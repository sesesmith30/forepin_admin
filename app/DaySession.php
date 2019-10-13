<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DaySession extends Model
{

	use SoftDeletes;
    
    protected $fillable = ["promoter_id","start_time","end_time","outlets_to_visit"];
}
