<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTutionFeeToStudent extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('students', function(Blueprint $table)
        {
            $table->double("tuition_fee");
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('students', function(Blueprint $table)
        {
            $table->dropColumn("tuition_fee");
        });
	}

}
