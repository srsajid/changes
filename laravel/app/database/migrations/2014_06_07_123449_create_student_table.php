<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration {

    public function up()
    {
        Schema::create("students", function(Blueprint $table){
            $table->increments("id");
            $table->string("name", 250);
            $table->string("sid", 250);
            $table->string("father_name")->nullable();
            $table->string("mother_name")->nullable();
            $table->string("guardian_name")->nullable();
            $table->dateTime("date_of_birth")->nullable();
            $table->dateTime("date_of_admission")->nullable();
            $table->string("gender")->nullable();
            $table->string("nationality")->nullable();
            $table->string("religion")->nullable();
            $table->string("address")->nullable();
            $table->string("contact_number")->nullable();
            $table->string("email")->nullable();
            $table->boolean("hasTransport")->nullable();
            $table->float("transport_cost")->nullable();
            $table->string("clazz")->nullable();
            $table->string("section")->nullable();
            $table->string("shift")->nullable();
            $table->boolean("has_rid")->nullable();
            $table->string("rid")->nullable();
            $table->string("rid_class")->nullable();
            $table->string("rid_section")->nullable();
        });
    }

    public function down()
    {
        Schema::drop("student");
    }

}
