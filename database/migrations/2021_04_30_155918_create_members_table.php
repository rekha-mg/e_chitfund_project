<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->integer('member_id')->primary('primary');
            $table->string('member_name', 25);
            $table->string('password', 10);
            $table->date('dob');
            $table->string('occupation', 50);
            $table->string('phone', 10);
            $table->string('address', 150);
            $table->string('email_id', 60);
            $table->string('adhar_card', 12);
            $table->string('pancard', 12);
            $table->tinyInteger('id_deleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
