<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SalaryAdjustmentTable extends Migration {


	public function up() {
		Schema::create("salary_histories", function(Blueprint $table) {
            $table->increments("id");
            $table->double("adjust_amount");
            $table->string("comment");
            $table->integer("user_id")->unsigned();
            $table->integer("beneficiary_id")->unsigned();
            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("beneficiary_id")->references("id")->on("beneficiaries");
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
	    Schema:drop("salary_histories");
    }

}
