<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePanelAddColumn20180920 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('panel_template', function (Blueprint $table) {
            $table->unsignedInteger('marked_domain')->after('unique_url')->nullable()->default('0');
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
            $table->dropColumn('marked_domain');
        });
    }
}
