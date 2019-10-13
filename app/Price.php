<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends Model
{
	use SoftDeletes;

    protected $fillable = ["item_code","supplier","item_description","price","is_push_product","price_group_id"];

    
}
