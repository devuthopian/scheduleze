<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceContentTable20180918 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_content', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->unsignedInteger('business_type_id')->default('0');
            $table->unsignedInteger('business')->default('0');
            $table->string('type_content')->nullable();
            $table->string('size_content')->nullable();
            $table->string('age_content')->nullable();
            $table->string('add_on_service_content')->nullable();
            $table->timestamps();

            $table->foreign('business')->references('id')->on('business');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_content');
    }
}
