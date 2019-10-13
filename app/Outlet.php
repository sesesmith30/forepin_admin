<?php

namespace App;

use App\OutletZone;
use App\User;
use App\Visit;
use App\Orders;
use App\Returns;
use App\Collections;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Outlet extends Model
{
    use SoftDeletes;

    protected $fillable = ["outlet_name","contact_person_name","position","mobile_number","locality","sub_locality","landmark","streetname","latitude","logitude","promoter_id","division","shop_type","client_classification","verify_auditor_id","auditor_verified","zone_id"];

    public function zone() {
    	return $this->hasOne(OutletZone::class,"id");
    }

    public function promoter() {
    	return $this->hasOne(User::class,"id","zone_id");
    }

    public function recruiter() {
        return $this->belongsTo(User::class,"promoter_id");
    }

    public function visits() {
    	return $this->hasMany(Visit::class);
    }

    public function orders() {

    	return $this->hasMany(Orders::class);
    }

    public function collections() {
    	return $this->hasMany(Collections::class);
    }

    public function returns() {

    	return $this->hasMany(Returns::class);
    }


}
