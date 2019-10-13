<?php

namespace App;

use App\User;
use App\Outlet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OutletZone extends Model
{

	use SoftDeletes;

    protected $fillable = ["name","assigned_promoter","locality"];


    public function outlets() {
    	return $this->hasMany(Outlet::class,"zone_id");
    }


    public function promoter() {
    	return $this->belongsTo(User::class,"assigned_promoter");
    }

}
