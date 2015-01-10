<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create("products", function(Blueprint $table){
            $table->increments("id");
            $table->string("name", 150);
            $table->double("cost_price");
            $table->double("sale_price");
            $table->double("available_stock")->default(0);
            $table->timestamps();
            $table->integer("category_id")->unsigned();
            $table->foreign("category_id")->references("id")->on("categories");
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
