<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InventoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create("inventory_histories", function(Blueprint $table) {
            $table->increments("id");
            $table->integer("quantity");
            $table->text("comment")->nullable();
            $table->integer("user_id")->unsigned();
            $table->integer("product_id")->unsigned();
            $table->timestamps();
            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("product_id")->references("id")->on("products");
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop("inventory_histories");
	}

}
