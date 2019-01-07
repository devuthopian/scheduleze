<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentFormTable20180809 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_form', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->unsignedInteger('panel_id')->unique();
            $table->unsignedInteger('user_id')->default('0');
            $table->longText('gjs_assets')->nullable();
            $table->longText('gjs_css')->nullable();
            $table->longText('gjs_styles')->nullable();
            $table->longText('gjs_html')->nullable();
            $table->longText('gjs_components')->nullable();
            $table->string('unique_url')->unique();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('panel_id')->references('id')->on('panel_template')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointment_form');
    }
}
