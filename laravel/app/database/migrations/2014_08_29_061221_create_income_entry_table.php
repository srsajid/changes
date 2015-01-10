<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomeEntryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create("income_entries", function(Blueprint $table) {
            $table->increments("id");
            $table->double("amount");
            $table->string("comment")->nullable();
            $table->integer("income_type_id")->unsigned();
            $table->foreign("income_type_id")->references("id")->on("income_types");
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
        Schema::drop("income_entries");
	}

}
