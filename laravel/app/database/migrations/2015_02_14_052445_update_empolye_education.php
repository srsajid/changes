<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEmpolyeEducation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
	    Schema::table("beneficiaries", function(Blueprint $table) {
            $table->string("father_name")->nullable();    
            $table->string("mother_name")->nullable();
            $table->string("national_id")->nullable();
        });
        
        Schema::table("educations", function(Blueprint $table){
           $table->string("board")->nullable();
        });
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
