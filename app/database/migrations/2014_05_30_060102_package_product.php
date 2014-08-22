<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PackageProduct extends Migration {

	public function up()
	{
        Schema::create("packages", function(Blueprint $table){
            $table->increments("id");
            $table->string("name", 100);
            $table->timestamps();
        });
	}
	public function down()
	{
        Schema::drop("packages");
	}

}
