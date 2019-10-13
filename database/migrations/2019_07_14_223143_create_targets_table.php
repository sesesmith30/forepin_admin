<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("admin_id");        //admin that initiated this
            $table->string("target_for");       //PROMOTERS //CAHSVANS
            $table->string("monthly_total_orders")->default("0");
            $table->string("monthly_total_collections")->default("0");
            $table->string("monthly_outlets_to_visit")->default("0");
            $table->string("monthly_new_pins_to_add")->default("0");
            $table->string("daily_outlets_to_visit")->default("0");
            $table->string("daily_total_orders")->default("0");
            $table->string("daily_total_collections")->default("0");
            $table->string("daily_new_pins_to_add")->default("0");
            $table->string("daily_average_time_at_outlet")->default("0");
            $table->boolean("is_active")->default(true);
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
        Schema::dropIfExists('targets');
    }
}
