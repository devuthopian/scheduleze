<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersDetailsTable3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_details', function (Blueprint $table) {
             $table->integer('padding_day')->nullable()->change();
            $table->integer('throttle')->nullable()->change();
           $table->integer('permission')->nullable()->change();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_details', function (Blueprint $table) {
             $table->integer('padding_day')->nullable()->change();
            $table->integer('throttle')->nullable()->change();
            $table->integer('permission')->nullable()->change();


        });
    }
}
