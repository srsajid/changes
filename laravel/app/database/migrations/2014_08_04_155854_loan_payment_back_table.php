<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LoanPaymentBackTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
	    Schema::create("loan_payment_back", function(Blueprint $table){
            $table->increments("id");
            $table->double("amount");
            $table->integer("user_id")->unsigned();
            $table->integer("load_given_id")->unsigned();
            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("load_given_id")->references("id")->on("loan_given");
        });
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
	    Schema::drop("loan_payment_back");
	}

}
