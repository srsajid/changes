<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PayrollMenusSeed extends Migration {

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
                    'title' => "Beneficiary",
                    'nav_menu' => 'payroll',
                    'ui_class' => 'icon-large icon-old-man',
                    'tab_id' => 'beneficiary',
                    'min_weight' => 4
                ),
                array(
                    'title' => "Salary",
                    'nav_menu' => 'payroll',
                    'ui_class' => 'icon-large icon-pie-chart',
                    'tab_id' => 'salary',
                    'min_weight' => 4
                ),
                array(
                    'title' => "Loan Given",
                    'nav_menu' => 'payroll',
                    'ui_class' => 'icon-large icon-credit',
                    'tab_id' => 'loan',
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
	public function down()
	{
		//
	}

}
