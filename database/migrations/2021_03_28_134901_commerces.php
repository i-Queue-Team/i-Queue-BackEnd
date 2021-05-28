<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Commerces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commerces', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->double('latitude',9,7,false);
            $table->double('longitude',10,7,false);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->unsignedInteger('user_id');
            //more to add in future
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commerces');
    }
}
