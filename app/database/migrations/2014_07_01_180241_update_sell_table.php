<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSellTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sells', function(Blueprint $table){
            $table->string("student_id")->nullable();
            $table->string("clazz")->nullable();
            $table->string("section")->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table("sells", function (Blueprint $table) {
            $table->dropColumn("student_id", "clazz", "section");
        });
	}

}
