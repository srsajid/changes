<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSudentRelatationOnFees extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
        Schema::table("tuition_fees", function(Blueprint $table){
            $table->integer("student_id")->unsigned();
            $table->foreign("student_id")->references("id")->on("students");
        });
        Schema::table("transport_fees", function(Blueprint $table){
            $table->integer("student_id")->unsigned();
            $table->foreign("student_id")->references("id")->on("students");
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
        Schema::table("tuition_fees", function(Blueprint $table){
            $table->dropColumn("student_id");
        });

        Schema::table("transport_fees", function(Blueprint $table){
            $table->dropColumn("student_id");
        });
	}

}
