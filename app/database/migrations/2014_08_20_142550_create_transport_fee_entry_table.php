<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportFeeEntryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create("transport_fees", function(Blueprint $table) {
            $table->increments("id");
            $table->string("student_id");
            $table->double("transport_cost");
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
        Schema::drop("transport_fees");
    }

}
