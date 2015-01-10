<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LoanPaymentBackTableTimeStamps extends Migration {

	public function up() {
		Schema::table("loan_payment_back", function(Blueprint $table) {
            $table->timestamps();
        });
	}

	public function down() {
        Schema::table("loan_payment_back", function(Blueprint $table) {
            $table->dropTimestamps();
        });
	}
}
