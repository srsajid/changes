<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserOnFeesAndFeeMenuSeed extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
	    Schema::table("tuition_fees", function(Blueprint $table){
            $table->integer("user_id")->unsigned();
            $table->foreign("user_id")->references("id")->on("users");
        });
        Schema::table("transport_fees", function(Blueprint $table){
            $table->integer("user_id")->unsigned();
            $table->foreign("user_id")->references("id")->on("users");
        });

        DB::table('menus')->insert(
            array(
                array(
                    'title' => "Tuition Fee",
                    'nav_menu' => 'administrator',
                    'ui_class' => 'icon-large icon-calendar',
                    'tab_id' => 'tuition_fee',
                    'min_weight' => 4
                ),
                array(
                    'title' => "Transport Fee",
                    'nav_menu' => 'administrator',
                    'ui_class' => 'icon-large icon-bus',
                    'tab_id' => 'transport_fee',
                    'min_weight' => 4
                )
            )
        );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
	    Schema::table("tuition_fees", function(Blueprint $table){
            $table->dropColumn("user_id");
        });

	    Schema::table("transport_fees", function(Blueprint $table){
            $table->dropColumn("user_id");
        });
    }

}
