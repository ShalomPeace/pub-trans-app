<?php

use Illuminate\Database\Seeder;

class StationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = [];

    	$stations = [
    		'North Avenue', 
    		'Quezon Avenue', 
    		'GMA Kamuning', 
    		'Araneta Cubao', 
    		'Santolan Anapolis', 
    		'Ortigas Center', 
    		'Shaw Boulevard', 
    		'Boni Avenue', 
    		'Guadalupe', 
    		'Buendia', 
    		'Ayala', 
    		'Magallanes', 
    		'Taft Avenue',
    	];

    	$timestamp = date('Y-m-d H:i:s');

    	foreach ($stations as $station) {
    		$data[] = [
    			'name'		 	=> $station, 
    			'created_at'	=> $timestamp, 
    			'updated_at' 	=> $timestamp, 
    			'user_id'	 	=> 1, 
    		];
    	}

        DB::table('stations')->insert($data);
    }
}
