<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentsTable20181011 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('cookie_id', 50)->nullable()->default('0');
            $table->unsignedInteger('booking')->nullable()->default('0');
            $table->string('name', 35)->nullable();
            $table->string('phone', 35)->nullable();
            $table->string('email', 35)->nullable();
            $table->tinyInteger('remember')->nullable()->default('0');
            $table->integer('removed')->nullable()->default('0');
            $table->timestamps();

            $table->foreign('booking')->references('id')->on('bookings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents');
    }
}
