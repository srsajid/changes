<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PackageItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create("package_items", function(Blueprint $table){
            $table->increments("id");
            $table->integer("quantity");
            $table->integer("product_id")->unsigned();
            $table->integer("package_id")->unsigned();
            $table->timestamps();
            $table->foreign("product_id")->references("id")->on("products");
            $table->foreign("package_id")->references("id")->on("packages");
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
