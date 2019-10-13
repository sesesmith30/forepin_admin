<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCollateralOtherToOutlets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('outlets', function (Blueprint $table) {
            $table->string("collateral")->nullable();
            $table->string("image_in_url")->nullable();
            $table->string("image_out_url")->nullable();
            $table->string("payment_terms")->nullable();
            $table->text("documents_1_image_url")->nullable();
            $table->text("documents_2_image_url")->nullable();
            $table->text("documents_3_image_url")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('outlets', function (Blueprint $table) {
            $table->dropColumn("collateral");
            $table->dropColumn("image_in_url");
            $table->dropColumn("image_out_url");
            $table->dropColumn("payment_terms");
            $table->dropColumn("documents_1_image_url");
            $table->dropColumn("documents_2_image_url");
            $table->dropColumn("documents_3_image_url");
        });
    }
}
