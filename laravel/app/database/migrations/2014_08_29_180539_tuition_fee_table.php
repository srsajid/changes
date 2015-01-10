<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TuitionFeeTable extends Migration {
    public function up(){
        Schema::create("tuition_fees", function(Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments("id");
            $table->integer("number_of_month");
            $table->double("amount");
            $table->double("discount")->defalts(0);
            $table->double("fine")->defalts(0);
            $table->string("comment")->nullable();
            $table->timestamps();
            $table->integer("tuition_fee_count_id")->unsigned();
            $table->foreign("tuition_fee_count_id")->references("id")->on("tuition_fee_counts");
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop("tuition_fees");
    }
}
