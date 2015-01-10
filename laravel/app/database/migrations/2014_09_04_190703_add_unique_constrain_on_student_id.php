<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniqueConstrainOnStudentId extends Migration {


	public function up() {
	    Schema::table("students", function(Blueprint $table){
            $table->unique("sid");
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
        Schema::table("students", function(Blueprint $table){
            $table->dropUnique("sid");
        });
	}

}
