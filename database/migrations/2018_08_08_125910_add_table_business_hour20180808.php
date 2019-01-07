<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableBusinessHour20180808 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bushour', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->unsignedInteger('user_id')->nullable()->default('0');
            $table->unsignedInteger('business')->default('0');
            $table->integer('starttime')->nullable();
            $table->integer('endtime')->nullable();
            $table->integer('day')->default('0');
            $table->integer('removed')->default('0');
            $table->timestamps();

            $table->index('day')->unsigned()->nullable();
            $table->index('removed')->unsigned()->nullable();
            $table->foreign('business')->references('id')->on('business')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bushour');
    }
}
