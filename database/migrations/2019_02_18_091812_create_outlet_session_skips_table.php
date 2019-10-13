<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutletSessionSkipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlet_session_skips', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("promoter_id");
            $table->integer("outlet_id");
            $table->integer("day_session_id");
            $table->text("reason");
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
        Schema::dropIfExists('outlet_session_skips');
    }
}
