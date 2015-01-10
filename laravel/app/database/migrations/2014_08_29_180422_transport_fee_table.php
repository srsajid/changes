<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransportFeeTable extends Migration {
    public function up(){
        Schema::create("transport_fees", function(Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments("id");
            $table->integer("number_of_month");
            $table->double("amount");
            $table->double("discount")->defalts(0);
            $table->double("fine")->defalts(0);
            $table->string("comment")->nullable();
            $table->timestamps();
            $table->integer("transport_fee_count_id")->unsigned();
            $table->foreign("transport_fee_count_id")->references("id")->on("transport_fee_counts");
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop("transport_fees");
    }
}
