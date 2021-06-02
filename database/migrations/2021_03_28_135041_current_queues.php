<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Currentqueues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_queues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fixed_capacity')->default(30);
            $table->integer('current_capacity')->default(0);;
            $table->integer('average_time')->default(0);
            $table->string('password_verification')->default(Str::random(20));
            $table->timestamps();

            //foreing key
            $table->foreign('commerce_id')->references('id')->on('commerces')->onDelete('CASCADE');
            $table->unsignedInteger('commerce_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('current_queues');
    }
}
