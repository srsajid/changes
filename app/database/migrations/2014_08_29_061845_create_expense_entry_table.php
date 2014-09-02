<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpenseEntryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create("expense_entries", function(Blueprint $table) {
            $table->increments("id");
            $table->double("amount");
            $table->string("comment")->nullable();
            $table->integer("expense_type_id")->unsigned();
            $table->foreign("expense_type_id")->references("id")->on("expense_types");
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
        Schema::drop("expense_entries");
	}

}
