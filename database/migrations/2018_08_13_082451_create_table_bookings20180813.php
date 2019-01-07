<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBookings20180813 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->unsignedInteger('user_id')->nullable()->default('0');
            $table->string('obscure_id', 12)->nullable();
            $table->string('inspection_address')->nullable();
            $table->unsignedInteger('business')->default('0');

            $table->string('firstname', 32)->nullable();
            $table->string('lastname', 35)->nullable();

            $table->string('homephone', 15)->nullable();
            $table->string('dayphone', 15)->nullable();

            $table->string('email', 48)->nullable();

            $table->string('address', 64)->nullable();
            $table->string('city', 32)->nullable();
            $table->char('state', 3)->nullable();
            $table->string('zip', 11)->nullable();

            $table->string('agent_name', 128)->nullable(); //agent name starts
            $table->string('agent_phone', 128)->nullable();
            $table->string('agent_email', 128)->nullable();

            $table->string('listing_agent', 128)->nullable(); //listing starts
            $table->string('listing_office', 128)->nullable();
            $table->string('listing_phone', 128)->nullable();

            $table->longText('entry_method')->nullable();
            $table->string('mls', 128)->nullable();
            $table->longText('user_notes')->nullable();

            $table->unsignedInteger('starttime')->nullable()->default('0');
            $table->unsignedInteger('endtime')->nullable()->default('0');
            $table->unsignedInteger('location')->nullable()->default('0');
            $table->integer('size')->nullable()->default('0');

            $table->integer('building_type')->nullable()->default('0');
            $table->integer('building_size')->nullable()->default('0');
            $table->integer('building_age')->nullable()->default('0');
            $table->string('price', 24)->nullable()->default('0');

            $table->unsignedInteger('type')->nullable()->default('0');
            $table->longText('notes')->nullable();
            $table->string('ip_added', 15)->nullable();
            $table->integer('added')->nullable();
            $table->string('ip_edited', 15)->nullable();
            $table->integer('edited')->nullable();
            $table->string('ip_removed', 15)->nullable();

            $table->unsignedInteger('removed')->default('0');
            $table->timestamps();

            $table->foreign('business')->references('id')->on('business')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
