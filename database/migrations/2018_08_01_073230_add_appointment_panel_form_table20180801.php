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
            $table->unsignedInteger('admin_id')->default('0');
            $table->unsignedInteger('user_id')->default('0');
            $table->longText('form_fields_name_value')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('admin_id')->references('id')->on('users');
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
