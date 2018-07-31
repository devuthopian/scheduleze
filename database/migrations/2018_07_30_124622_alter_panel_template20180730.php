<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPanelTemplate20180730 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('panel_template', function (Blueprint $table) {
            $table->string('unqiue_url')->after('gjs_components')->unique();
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
            $table->dropColumn('unqiue_url');
        });
    }
}
