<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NoAction extends Model
{
    use SoftDeletes;

    protected $fillable = ["promoter_id","outlet_id","reason"];

}
