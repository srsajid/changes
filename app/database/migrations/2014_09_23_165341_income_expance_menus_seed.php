<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IncomeExpanceMenusSeed extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::table('menus')->insert(
            array(
                array(
                    'title' => "Income Types",
                    'nav_menu' => 'administrator',
                    'ui_class' => 'glyphicon glyphicon-plus-sign',
                    'tab_id' => 'income',
                    'min_weight' => 1
                ),
                array(
                    'title' => "Expense Types",
                    'nav_menu' => 'administrator',
                    'ui_class' => 'glyphicon glyphicon-minus-sign',
                    'tab_id' => 'expense',
                    'min_weight' => 1
                ),
                array(
                    'title' => "Income Entry",
                    'nav_menu' => 'administrator',
                    'ui_class' => 'glyphicon glyphicon-import',
                    'tab_id' => 'income_entry',
                    'min_weight' => 1
                ),
                array(
                    'title' => "Expense Entry",
                    'nav_menu' => 'administrator',
                    'ui_class' => 'glyphicon glyphicon-export',
                    'tab_id' => 'expense_entry',
                    'min_weight' => 1
                )
            )
        );
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
