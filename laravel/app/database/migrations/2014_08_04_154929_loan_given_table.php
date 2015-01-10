<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LoanGivenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
	    Schema::create("loan_given", function(Blueprint $table) {
            $table->increments("id");
            $table->double("amount");
            $table->double("paid")->nullable();
            $table->string("is_paid", 1);
            $table->integer("user_id")->unsigned();
            $table->integer("beneficiary_id")->unsigned();
            $table->timestamps();
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
        Schema::drop("loan_given");
	}

}
