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
        /*Schema::create("tuition_fees", function(Blueprint $table) {
            $table->increments("id");
            $table->string("student_id")->unique();
            $table->string("total")->nullable();
            $table->string("status", 1);
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::drop("income_types");
    }

}
