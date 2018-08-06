<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePanelTemplateTable20180730 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panel_template', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->unsignedInteger('user_id')->default('0');
            $table->longText('gjs_assets')->nullable();
            $table->longText('gjs_css')->nullable();
            $table->longText('gjs_styles')->nullable();
            $table->longText('gjs_html')->nullable();
            $table->longText('gjs_components')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('panel_template');
    }
}
