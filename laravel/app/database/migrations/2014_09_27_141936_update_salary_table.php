<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSalaryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
        Schema::table("salaries", function(Blueprint $table) {
           $table->float("extra_payment")->default(0);
           $table->float("deduction")->default(0);
           $table->string("comment")->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
        Schema::table("salaries", function(Blueprint $table) {
            $table->dropColumn("extra_payment");
            $table->dropColumn("deduction");
            $table->dropColumn("comment");
        });
	}

}
