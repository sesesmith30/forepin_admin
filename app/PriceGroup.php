<?php

namespace App;

use App\Price;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PriceGroup extends Model
{
	use SoftDeletes;

    protected $fillable = ["id","group_name"];

   
   public function prices() {
	return $this->hasMany(Price::class);
   }

}
