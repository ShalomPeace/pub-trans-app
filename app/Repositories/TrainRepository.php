<?php

namespace App\Repositories;

use App\Models\Train;
use App\Repositories\Contracts\TrainRepositoryInterface;

class TrainRepository extends Repository implements TrainRepositoryInterface
{
    public function __construct(Train $model)
    {
        $this->model = $model;
    }

    public function getTrainList() 
    {
    	return $this->model->active()
    					   ->get();
    }

    public function getTrainWithSchedules($id) 
    {
    	$train = $this->find($id);

        $train->load('schedules', 'schedules.departure_station', 'schedules.arrival_station', 'schedules.train', 'schedules.operator');
    
        return $train;
    }

    public function getNextCode() 
    {
    	$last = $this->model->orderBy('id', 'DESC')->first(['code']);

    	$code = 'TRN-0001';

    	if ($last) {
    		list($abbr, $num) = explode('-', $last->code);

			$next = str_pad($num + 1, 4, 0, STR_PAD_LEFT);

			$code = $abbr . '-' . $next; 		
    	}

    	return $code;
    }
}
