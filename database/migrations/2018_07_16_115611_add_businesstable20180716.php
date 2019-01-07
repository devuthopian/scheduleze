<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBusinesstable20180716 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('user_id');
            $table->integer('type')->default('1');
            $table->string('name',255)->nullable();
            $table->tinyInteger('is_do_payment')->default('1');
            $table->string('contact_firstname',255)->nullable();
            $table->string('contact_lastname',255)->nullable();
            $table->string('address',255)->nullable();
            $table->string('public_address',255)->nullable();
            $table->string('city',255)->nullable();
            $table->string('state',255)->nullable();
            $table->string('zip',255)->nullable();
            $table->string('phone',255)->nullable();
            $table->string('public_phone',255)->nullable();
            $table->string('phone2',255)->nullable();
            $table->string('phone2_name',255)->nullable();
            $table->integer('timezone')->default('0');
            $table->string('email',255)->nullable();
            $table->string('email2',255)->nullable();
            $table->string('public_email',255)->nullable();
            $table->string('website',255)->nullable();
            $table->boolean('require_listing_agent')->default('0');
            $table->boolean('require_agent')->default('0');
            $table->boolean('agent_company_label')->default('0');
            $table->boolean('require_inspection_zip')->default('0');
            $table->boolean('print_ticket_email')->default('0');
            $table->boolean('offer_cancellation')->default('0');
            $table->integer('no_cancel_within')->default('48');
            $table->boolean('show_addon_price')->default('1');
            $table->integer('enotice_days_before')->nullable();
            $table->boolean('paypal')->default('0');
            $table->string('paypal_email',128)->nullable();
            $table->string('email_attachment',128)->nullable();
            $table->integer('include_event_ics')->default('0');
            $table->text('first_screen_note')->nullable();
            $table->string('ip_modify',15)->nullable();
            $table->integer('modified')->default('0');
            $table->bigInteger('account_opened')->default('0');
            $table->integer('removed')->default('0');
            $table->string('registration_id',32)->nullable();
            $table->bigInteger('registration_email_date')->unsigned()->nullable();
            $table->tinyInteger('registration_completed')->unsigned()->default('0');
            $table->timestamps();

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
        Schema::dropIfExists('business');
    }
}
