<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAppointmentPanelFormTable20180801 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_panel_form', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->unsignedInteger('user_id')->default('0');
            $table->longText('gjs_assets')->nullable();
            $table->longText('gjs_css')->nullable();
            $table->longText('gjs_styles')->nullable();
            $table->longText('gjs_html')->nullable();
            $table->longText('gjs_components')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('appointment_panel_form');
    }
}
