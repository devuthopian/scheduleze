<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBuildingSizesTable20180718 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_sizes', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->unsignedInteger('business')->default('0');
            $table->string('name',150)->nullable();
            $table->integer('buffer')->unsigned()->default('0');
            $table->integer('price')->unsigned()->default('0');
            $table->integer('status')->unsigned()->default('0');
            $table->integer('rank')->unsigned()->default('0');
            $table->integer('daily_cap')->unsigned()->default('0');
            $table->integer('selected')->unsigned()->default('0');
            $table->integer('removed')->unsigned()->default('0');
            $table->timestamps();

            $table->index('name',150)->unsigned()->nullable();
            $table->foreign('business')->references('id')->on('business')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('building_sizes');
    }
}
