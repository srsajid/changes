<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create("menus", function(Blueprint $table){
            $table->increments("id");
            $table->string("title", 100);
            $table->string("nav_menu", 100);
            $table->string("ui_class", 100);
            $table->string("tab_id", 100);
            $table->integer("min_weight");
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("menus");
	}

}
