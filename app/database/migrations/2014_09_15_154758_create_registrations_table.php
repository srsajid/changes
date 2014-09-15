<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create("registrations", function(Blueprint $table){
            $table->increments("id");
            $table->timestamps();
            $table->boolean("hasTransport")->nullable();
            $table->float("transport_fee")->nullable();
            $table->string("clazz")->nullable();
            $table->dateTime("year")->nullable();
            $table->string("section")->nullable();
            $table->string("shift")->nullable();
            $table->boolean("has_rid")->nullable();
            $table->string("rid")->nullable();
            $table->string("rid_class")->nullable();
            $table->string("rid_section")->nullable();
            $table->boolean("is_readmission")->nullable();
            $table->float("admission_fee")->nullable();
            $table->float("readmission_fee")->nullable();
            $table->integer("student_id")->unsigned();
            $table->foreign("student_id")->references("id")->on("student_informations");
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop("registrations");
	}

}
