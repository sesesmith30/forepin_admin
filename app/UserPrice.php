<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPrice extends Model
{

	use SoftDeletes;

    protected $table = 'user_prices';

    protected $fillable = ['user_id', 'price_id'];

    public function price() {
    	return $this->belongsTo(Price::class, 'price_id');
    }

    public function user() {
    	return $this->belongsTo(User::class, 'user_id');
    }
}
