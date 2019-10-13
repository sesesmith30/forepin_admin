<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutletSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlet_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("promoter_id");     //userId
            $table->integer("outlet_id");
            $table->text("shelf_pic_one_url");
            $table->text("shelf_pic_two_url")->nullable();
            $table->string("product_order");
            $table->string("amount_collected");
            $table->text("representative_signature_url");
            $table->date("start_date");
            $table->date("end_date")->nullable();
            $table->integer("status")->default("0");   //PENDING(0)     //SUCCESFULL(1)      //FAILED(-1) 
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
        Schema::dropIfExists('outlet_sessions');
    }
}
