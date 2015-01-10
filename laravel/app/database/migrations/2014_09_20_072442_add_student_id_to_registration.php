<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStudentIdToRegistration extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('registrations', function(Blueprint $table)
        {
            $table->string("student_unique_id");
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('registrations', function(Blueprint $table)
        {
            $table->dropColumn("student_unique_id");
        });
	}

}
