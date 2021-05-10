<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLuckyLakshmiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lucky_lakshmi', function (Blueprint $table) {
            $table->integer('id')->primary('primary');
            $table->date('due_date');
            $table->double('total_amount', 8, 2);
            $table->double('bit_amount', 8, 2);
            $table->string('bit_amount_received', 8);
            $table->double('commission', 8, 2);
            $table->double('remaining_amount', 8, 2);
            $table->date('next_bit_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lucky_lakshmi');
    }
}
