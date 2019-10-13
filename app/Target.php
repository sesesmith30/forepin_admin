<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Target extends Model
{

	use SoftDeletes;
    
    // protected $fillable = ["admin_id","promoter_id","outlets","reason","day"];

   
}
