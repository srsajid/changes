<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PermissionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
        Schema::create("permissions", function(Blueprint $table) {
            $table->increments("id");
            $table->boolean("is_allowed");
            $table->string("controller");
            $table->string("action");
            $table->integer("user_id")->unsigned();
            $table->foreign("user_id")->references("id")->on("users");
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
	    Schema::drop("permissions");
    }

}
