<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OutletSession extends Model
{

	use SoftDeletes;

    protected $fillable = ["promoter_id","outlet_id","shelf_pic_one_url","shelf_pic_two_url","product_order","amount_collected","representative_signature_url","status","start_date","end_date"];

}
