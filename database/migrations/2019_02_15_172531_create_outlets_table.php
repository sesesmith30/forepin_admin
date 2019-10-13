<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlets', function (Blueprint $table) {
            $table->increments('id');
            $table->string("outlet_name");
            $table->string("contact_person_name");
            $table->string("position");
            $table->string("mobile_number");
            $table->string("locality");
            $table->string("sub_locality");
            $table->string("landmark");
            $table->string("streetname")->nullable();
            $table->string("latitude");
            $table->string("logitude");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outlets');
    }
}
