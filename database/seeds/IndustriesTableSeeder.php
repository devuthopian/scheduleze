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
    	$inspectors_page_name = array('0' => 'Home Inspection', '1' => 'Mortgage Lender', '2' => 'Real Estate Agent', '3' => 'House Doctor', '4' => 'Appliance Repair', '5' => 'Auto Service', '6' => 'Hair Salon', '7' => 'Photographer', '8' => 'Tire Service', '9' => 'Property Management', '10' => 'Aviation');

    	$inspectors_name = array('0' => 'Inspector', '1' => 'Lender', '2' => 'Realtor', '3' => 'Handyman', '4' => 'Technician', '5' => 'Service Bay', '6' => 'Stylist', '7' => 'Photographer', '8' => 'Bay', '9' => 'Unit', '10' => 'Pilot');

    	for ($i=0; $i < count($inspectors_page_name); $i++) { 
    		DB::table('industries')->insert(['name' => $inspectors_page_name[$i], 'page_name' => $inspectors_name[$i]]);
    	}
    }
}