<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SellItemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('sell_items', function(Blueprint $table) {
            $table->increments("id");
            $table->integer("productId")->unsigned();
            $table->string("productName");
            $table->double("productPrice");
            $table->integer("sell_id")->unsigned();
            $table->foreign("sell_id")->references("id")->on("sells");
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("sell_items");
	}

}
