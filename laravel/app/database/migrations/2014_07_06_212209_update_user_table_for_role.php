<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserTableForRole extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table("users", function(Blueprint $table){
            $table->string("first_name", 100);
            $table->string("last_name", 100)->nullable();
            $table->integer("weight");
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table("users", function(Blueprint $table){
            $table->dropColumn("first_name", "last_name", "weight");
        });
	}

}
