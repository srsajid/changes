<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TuitionFeeCountTable extends Migration {
    public function up(){
        Schema::create("tuition_fee_counts", function(Blueprint $table){
            $table->engine = "InnoDB" ;
            $table->increments("id");
            $table->integer("year");
            $table->integer("month_count")->defalts(0);
            $table->integer("student_id")->unsigned();
            $table->timestamps();
            $table->foreign("student_id")->references("id")->on("students");
            $table->unique(array("year", "student_id"));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop("tuition_fee_counts");
    }
}
