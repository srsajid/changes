<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImagesToStudentInfo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('student_informations', function(Blueprint $table)
        {
            $table->string("student_img")->nullable();
            $table->string("father_img")->nullable();
            $table->string("mother_img")->nullable();
            $table->string("guardian_img")->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('student_informations', function(Blueprint $table)
        {
            $table->dropColumn("student_img");
            $table->dropColumn("father_img");
            $table->dropColumn("mother_img");
            $table->dropColumn("guardian_img");
        });
	}

}
