<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiaryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create("beneficiaries", function(Blueprint $table) {
            $table->increments("id");
            $table->string("name");
            $table->string("email")->nullable();
            $table->string("phone")->unique();
            $table->string("address");
            $table->string("designation");
            $table->integer("type");
            $table->double("salary");
            $table->string("status", 1);
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
        Schema::drop("beneficiaries");
	}

}
