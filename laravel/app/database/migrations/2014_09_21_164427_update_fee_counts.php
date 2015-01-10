<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFeeCounts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
	    Schema::table("transport_fee_counts", function(Blueprint $table) {
            $table->dropForeign("transport_fee_counts_student_id_foreign");
            $table->dropColumn("student_id");
            $table->integer("student_information_id")->unsigned();
            $table->foreign("student_information_id")->references("id")->on("student_informations");
        });

        Schema::table("transport_fees", function(Blueprint $table) {
            $table->dropForeign("transport_fees_student_id_foreign");
            $table->dropColumn("student_id");
            $table->integer("student_information_id")->unsigned();
            $table->foreign("student_information_id")->references("id")->on("student_informations");
        });

        Schema::table("tuition_fee_counts", function(Blueprint $table) {
            $table->dropForeign("tuition_fee_counts_student_id_foreign");
            $table->dropColumn("student_id");
            $table->integer("student_information_id")->unsigned();
            $table->foreign("student_information_id")->references("id")->on("student_informations");
        });

        Schema::table("tuition_fees", function(Blueprint $table) {
            $table->dropForeign("tuition_fees_student_id_foreign");
            $table->dropColumn("student_id");
            $table->integer("student_information_id")->unsigned();
            $table->foreign("student_information_id")->references("id")->on("student_informations");
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
