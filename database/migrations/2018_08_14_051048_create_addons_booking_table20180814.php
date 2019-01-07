<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddonsBookingTable20180814 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addons_bookings', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->unsignedInteger('addon')->nullable()->default('0');
            $table->unsignedInteger('booking')->nullable()->default('0');
            $table->timestamps();

            $table->foreign('booking')->references('id')->on('bookings')->onDelete('cascade');
            $table->foreign('addon')->references('id')->on('addons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addons_bookings');
    }
}
