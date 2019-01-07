<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReport20180828 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->unsignedInteger('booking')->nullable()->default('0');
            $table->string('code', 12)->nullable();
            $table->string('pdf', 128)->nullable();
            $table->text('summary')->nullable();
            $table->text('memo', 6)->nullable();
            $table->integer('views')->nullable()->default('0');
            $table->string('ip_posted', 15)->nullable();
            $table->integer('added')->nullable()->default('0');
            $table->integer('expire')->nullable()->default('0');
            $table->integer('removed')->nullable()->default('0');
            $table->timestamps();

            $table->foreign('booking')->references('id')->on('bookings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
