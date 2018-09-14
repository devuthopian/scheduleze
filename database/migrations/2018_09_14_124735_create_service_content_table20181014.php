<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceContentTable20181014 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_content', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->unsignedInteger('business_types')->nullable()->default('0');
            $table->string('type_label')->nullable();
            $table->string('size_label')->nullable();
            $table->string('age_label')->nullable();
            $table->string('addon_label')->nullable();
            $table->integer('removed')->nullable()->default('0');
            $table->timestamps();

            $table->foreign('business_types')->references('id')->on('business_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_content');
    }
}
