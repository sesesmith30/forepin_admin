<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToOutletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('outlets', function (Blueprint $table) {
            $table->string("shop_type")->nullable();
            $table->string("client_classification")->nullable();    //category
            $table->string("sub_category_of_account")->nullable();
            $table->string("division")->nullable();
            $table->string("type_of_ownership")->nullable();
            $table->string("company_identification")->nullable();
            $table->string("registration_number")->nullable();
            $table->string("legal_comapany_name")->nullable();
            $table->string("trading_name")->nullable();
            $table->string("vat_registration_no")->nullable();
            $table->string("tin_registration_no")->nullable();
            $table->integer("promoter_id")->nullable();         //Id of promoter that added it 
            $table->string("verify_auditor_id")->nullable();        //Id of auditor that 
            $table->boolean("auditor_verified")->default(false);
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
        Schema::table('outlets', function (Blueprint $table) {
            //
            $table->dropColumn("shop_type");
            $table->dropColumn("client_classification");
            $table->dropColumn("division");
            $table->dropColumn("promoter_id");
            $table->dropColumn("verify_auditor_id");
            $table->dropColumn("auditor_verified");
        });
    }
}
