<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessType20181011 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_types', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('business', 128)->nullable();
            $table->string('directory', 36)->nullable();
            $table->string('agent_name', 128)->nullable();
            $table->string('type_label', 56)->nullable();
            $table->string('size_label', 56)->nullable();
            $table->string('age_label', 56)->nullable();
            $table->string('addon_label', 56)->nullable();
            $table->string('header_file', 56)->nullable();
            $table->integer('appointment_address')->nullable()->default('1');
            $table->integer('agent_information')->nullable()->default('0');
            $table->integer('random_image_start')->nullable()->default('1');
            $table->integer('random_image_end')->nullable()->default('3');
            $table->integer('removed')->nullable()->default('0');
            $table->timestamps();

            $table->foreign('business')->references('id')->on('business')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_types');
    }
}
