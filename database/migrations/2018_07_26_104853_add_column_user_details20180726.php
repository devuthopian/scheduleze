<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnUserDetails20180726 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_details', function (Blueprint $table) {
            $table->unsignedInteger('indus_id')->after('user_id')->nullable(false);

            /*$table->foreign('indus_id')->references('id')->on('industries');*/
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
            $table->dropColumn('indus_id');
        });
    }
}
