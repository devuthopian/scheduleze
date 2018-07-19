<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('obscure_id',12)->nullable();
            $table->tinyInteger('is_do_payment')->default('1');
            $table->integer('business')->default('0');
            $table->integer('hidden')->default('0');
            $table->string('name',32)->nullable();
            $table->string('lastname',35)->nullable();
            $table->string('public_name',255)->nullable();
            $table->string('email2',255)->nullable();
            $table->tinyInteger('permission')->default('0');
            $table->tinyInteger('zigzag')->default('0');
            $table->tinyInteger('zzamount')->default('0');
            $table->integer('increment')->default('900');
            $table->integer('look_ahead')->default('12');
            $table->integer('allow_conflict')->default('0');
            $table->integer('preferred_location')->default('0');
            $table->string('preferred_zip',12)->nullable();
            $table->string('url',255)->nullable();
            $table->integer('padding_day')->default('1');
            $table->integer('throttle')->default('1');
            $table->integer('last_login')->default('0');
            $table->string('last_ip',15)->nullable();
            $table->integer('added')->nullable();
            $table->integer('removed')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_details');
    }
}
