<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentInfo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create("student_informations", function(Blueprint $table){
            $table->engine = "InnoDB";
            $table->increments("id");
            $table->string("name", 250);
            $table->string("student_id", 250);
            $table->string("father_name")->nullable();
            $table->string("mother_name")->nullable();
            $table->string("guardian_name")->nullable();
            $table->dateTime("date_of_birth")->nullable();
            $table->string("gender")->nullable();
            $table->string("nationality")->nullable();
            $table->string("religion")->nullable();
            $table->string("address")->nullable();
            $table->string("contact_number")->nullable();
            $table->string("email")->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop("student_informations");
	}

}
