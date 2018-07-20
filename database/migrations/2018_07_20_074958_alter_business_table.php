<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business', function (Blueprint $table) {
           $table->integer('paypal')->nullable()->change();
           $table->integer('offer_cancellation')->nullable()->change();
           $table->integer('require_inspection_zip')->nullable()->change();
           $table->integer('print_ticket_email')->nullable()->change();
           $table->integer('require_agent')->nullable()->change();
           $table->integer('require_listing_agent')->nullable()->change();
           $table->integer('agent_company_label')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business', function (Blueprint $table) {
             $table->integer('paypal')->nullable()->change();
           $table->integer('offer_cancellation')->nullable()->change();
           $table->integer('require_inspection_zip')->nullable()->change();
           $table->integer('print_ticket_email')->nullable()->change();
           $table->integer('require_agent')->nullable()->change();
           $table->integer('require_listing_agent')->nullable()->change();
           $table->integer('agent_company_label')->nullable()->change();


        });
    }
}
