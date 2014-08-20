<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutionFeeEntryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create("tuition_fees", function(Blueprint $table) {
            $table->increments("id");
            $table->string("student_id");
            $table->double("tuition");
            $table->double("fine")->default(0);
            $table->double("total");
            $table->date("date");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("tuition_fees");
    }

}
