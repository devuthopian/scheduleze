<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndustriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$inspectors_page_name = array('0' => 'agents','1' => 'appliance', '2' => 'auto_service', '3' => 'aviators', '4' => 'handyman', '5' => 'inspectors', '6' => 'lenders', '7' => 'payment', '8' => 'photo', '9' => 'rentals', '10' => 'salon', '11' => 'tire');

    	$inspectors_name = array('0' => 'Agents','1' => 'Appliance', '2' => 'Auto Service', '3' => 'Aviators', '4' => 'Handyman', '5' => 'Inspectors', '6' => 'Lenders', '7' => 'Payment', '8' => 'Photo', '9' => 'Rentals', '10' => 'Salon', '11' => 'Tire');

    	for ($i=0; $i < count($inspectors_page_name); $i++) { 
    		DB::table('industries')->insert(['name' => $inspectors_page_name[$i], 'page_name' => $inspectors_name[$i]]);
    	}
    }
}