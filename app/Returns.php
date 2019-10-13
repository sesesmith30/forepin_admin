<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Returns extends Model
{

	use SoftDeletes;

    protected $fillable = ["promoter_id","outlet_id","returns_gson","price","reason"];

    


}
