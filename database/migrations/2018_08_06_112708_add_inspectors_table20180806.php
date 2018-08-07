<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInspectorsTable20180806 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspectors', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->tinyInteger('is_do_payment')->default('1');
            $table->unsignedInteger('business')->default('0');
            $table->integer('hidden')->default('0');
            $table->string('name');
            $table->string('lastname')->nullable();
            $table->string('username')->nullable();
            $table->string('public_name')->nullable();
            $table->string('email')->nullable();
            $table->string('email2')->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('permission')->nullable()->default('0');
            $table->tinyInteger('zigzag')->nullable()->default('0');
            $table->tinyInteger('zzamount')->nullable()->default('0');
            $table->integer('increment')->default('900');
            $table->integer('look_ahead')->nullable()->default('12');
            $table->integer('allow_conflict')->default('0');
            $table->integer('preferred_location')->default('0');
            $table->string('preferred_zip',12)->nullable();
            $table->string('url',255)->nullable();
            $table->integer('padding_day')->nullable()->default('1');
            $table->integer('throttle')->nullable()->default('1');
            $table->integer('last_login')->nullable()->default('0');
            $table->string('last_ip',15)->nullable();
            $table->integer('added')->nullable();
            $table->integer('removed')->nullable()->default('0');
            $table->timestamps();

            $table->index('name')->unsigned()->nullable();
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
        Schema::dropIfExists('inspectors');
    }
}
