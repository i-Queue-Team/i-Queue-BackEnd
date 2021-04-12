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
        Schema::create('Statistics', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('position');
            // date where user is estimated to enter bussisenes
            $table->date('estimated_time');
            //default
            $table->timestamps();

            //foreing key commerces
            $table->foreign('commerce_id')->references('id')->on('commerces')->onDelete('CASCADE');
            $table->unsignedInteger('commerce_id');

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
        //
    }
}
