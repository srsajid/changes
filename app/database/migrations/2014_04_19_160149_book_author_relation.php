<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookAuthorRelation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create("book_author",function(Blueprint $table) {
            $table->increments('id');
            $table->integer("book_id")->unsigned();
            $table->integer("author_id")->unsigned();
            $table->foreign("book_id")->references("id")->on("books");
            $table->foreign("author_id")->references("id")->on("authors");

        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('book_author');
	}

}
