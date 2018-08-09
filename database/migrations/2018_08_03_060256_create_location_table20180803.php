<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationTable20180803 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->unsignedInteger('business')->default('0');
            $table->string('name',99)->nullable();
            $table->integer('price')->unsigned()->default('0');
            $table->integer('removed')->unsigned()->default('0');
            $table->timestamps();

            $table->index('name',99)->unsigned()->nullable();
            $table->index('removed')->unsigned();
            $table->foreign('business')->references('id')->on('business');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
