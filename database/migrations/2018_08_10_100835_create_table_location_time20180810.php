<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLocationTime20180810 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_time', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->unsignedInteger('user_id')->nullable()->default('0');
            $table->unsignedInteger('business')->default('0');
            $table->integer('start')->nullable()->default('0');
            $table->integer('destination')->nullable()->default('0');
            $table->integer('time')->nullable()->default('0');;
            $table->integer('removed')->nullable()->default('0');
            $table->timestamps();

            $table->foreign('business')->references('id')->on('business');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location_time');
    }
}
