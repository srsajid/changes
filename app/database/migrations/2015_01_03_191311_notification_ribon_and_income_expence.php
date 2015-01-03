<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NotificationRibonAndIncomeExpence extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
        DB::table('menus')->insert(
                array(
                    'title' => "Promotion Notification",
                    'nav_menu' => 'payroll',
                    'ui_class' => 'glyphicon glyphicon-time',
                    'tab_id' => 'notification',
                    'min_weight' => 4
                )
        );

        Schema::table("expense_entries", function(Blueprint $table) {
            $table->integer("user_id")->unsigned();
            $table->foreign("user_id")->references('id')->on("users");
        });
        Schema::table("income_entries", function(Blueprint $table) {
            $table->integer("user_id")->unsigned();
            $table->foreign("user_id")->references('id')->on("users");
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
