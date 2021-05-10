<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chits', function (Blueprint $table) {
            $table->integer('chit_id')->primary('primary');
            $table->string('chit_name', 30);
            $table->double('capital_amount');
            $table->integer('total_members');
            $table->double('monthly_payment');
            $table->integer('duration');
            $table->date('start_date');
            $table->date('ending_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chits');
    }
}
