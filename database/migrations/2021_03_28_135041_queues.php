<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Queues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fixed_capacity');
            $table->integer('average_time');
            $table->string('password_verification');
            $table->timestamps();

            //foreing key
            $table->foreign('bussiness_id')->references('id')->on('businesses')->onDelete('CASCADE');
            $table->unsignedInteger('bussiness_id');
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
