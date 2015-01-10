<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookAurthor extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('books', function(Blueprint $table) {
            $table->increments("id");
            $table->string("name");
        });

        Schema::create('authors', function(Blueprint $table) {
            $table->increments("id");
            $table->string("name");
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop("users");
        Schema::drop("authors");
	}

}
