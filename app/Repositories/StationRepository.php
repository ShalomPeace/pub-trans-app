<?php

namespace App\Repositories;

use App\Models\Station;
use App\Repositories\Contracts\StationRepositoryInterface;

class StationRepository extends Repository implements StationRepositoryInterface
{
    public function __construct(Station $model)
    {
        $this->model = $model;
    }

    public function getStationsWithSchedules() 
    {
    	return $this->model->active()
    					   ->with('departure_schedules', 'arrival_schedules')
    					   ->get();
    }

    public function getStationWithSchedules($id) 
    {
        $station = $this->find($id);

        $station->load('departure_schedules', 'departure_schedules.arrival_station', 'departure_schedules.train', 'departure_schedules.operator');
        $station->load('arrival_schedules', 'arrival_schedules.arrival_station', 'arrival_schedules.train', 'arrival_schedules.operator');

        return $station;
    }
}
