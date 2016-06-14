<?php

use Illuminate\Database\Seeder;

class TrainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

    	$trains = [
    		'TRN-0001' => 'Train 1', 
    		'TRN-0002' => 'Train 2', 
    		'TRN-0003' => 'Train 3', 
    		'TRN-0004' => 'Train 4', 
    		'TRN-0005' => 'Train 5', 
    		'TRN-0006' => 'Train 6', 
    		'TRN-0007' => 'Train 7', 
    		'TRN-0008' => 'Train 8', 
    		'TRN-0009' => 'Train 9', 
    		'TRN-0010' => 'Train 10', 
    	];

    	$timestamp = date('Y-m-d H:i:s');

    	foreach ($trains as $code => $train) {
    		$data[] = [
    			'code'			=> $code,
    			'name'		 	=> $train, 
    			'total_seats'	=> rand(50, 100), 
    			'active'		=> 1,
    			'created_at'	=> $timestamp, 
    			'updated_at' 	=> $timestamp, 
    			'user_id'	 	=> 1, 
    		];
    	}

        DB::table('trains')->insert($data);
    }
}
