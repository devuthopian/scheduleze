<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAppointmentFormTable20180801 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointment_panel_form', function (Blueprint $table) {
            $table->unsignedInteger('admin_id')->default('0')->after('id');

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
        Schema::table('appointment_panel_form', function (Blueprint $table) {
            $table->dropColumn('admin_id');
        });
    }
}
