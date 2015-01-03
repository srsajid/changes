<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BeneficiaryModification extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
	    Schema::table("beneficiaries", function(Blueprint $table) {
            $table->dropColumn("address");
            $table->string("address_1");
            $table->string("address_2")->nullable();
            $table->string("sex", 10);
            $table->string("employee_id");
            $table->date("join_date");
            $table->date("last_increment_date");
            $table->string("campus");
        });

        Schema::table("salary_histories", function(Blueprint $table) {
            $table->string("type");
            $table->date("date");
        });

        Schema::create("educations", function(Blueprint $table) {
            $table->increments("id");
            $table->string("degree");
            $table->string("institution");
            $table->string("grade")->nullable();
            $table->integer("beneficiary_id")->unsigned();
            $table->foreign("beneficiary_id")->references("id")->on("beneficiaries");
        });
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
