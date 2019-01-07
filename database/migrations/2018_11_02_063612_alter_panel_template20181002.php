<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPanelTemplate20181002 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('panel_template', function (Blueprint $table) {
            //$table->unsignedInteger('business')->after('user_id');
            //$table->foreign('business')->references('id')->on('business');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('panel_template', function (Blueprint $table) {
            $table->dropColumn('business');
        });
    }
}
