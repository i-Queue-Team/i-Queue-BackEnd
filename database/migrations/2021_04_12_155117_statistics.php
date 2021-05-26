<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Statistics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('position');
            // date where user is estimated to enter bussisenes
            $table->dateTime('estimated_time');
            //default
            $table->timestamps();
            //foreing key queue
            $table->foreign('queue_id')->references('id')->on('current_queues')->onDelete('CASCADE')->unique();
            $table->unsignedInteger('queue_id');

            //foreing key user
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->unsignedInteger('user_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistics');
    }
}
