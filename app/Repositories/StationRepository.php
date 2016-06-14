<?php

namespace App\Repositories;

use App\Models\Station;
use App\Repositories\Contracts\StationRepositoryInterface;

class StationRepository extends Repository implements StationRepositoryInterface
{
    /**
     * Constructor
     * 
     * @param \App\Models\Station $model
     */
    public function __construct(Station $model)
    {
        $this->model = $model;
    }

    /**
     * Get station with departure and arrival schedules.
     * 
     * @return Illuminate\Database\Eloquent\Collection|null
     */
    public function getStationsWithSchedules() 
    {
    	return $this->model->active()
    					   ->with('departure_schedules', 'arrival_schedules')
    					   ->get();
    }

    /**
     * Get station by its primary key and  
     * 
     * @param  integer $id
     * @return \App\Models\Station
     */
    public function getStationWithSchedules($id) 
    {
        $station = $this->find($id);

        $station->load('departure_schedules', 'departure_schedules.arrival_station', 'departure_schedules.train', 'departure_schedules.operator');
        $station->load('arrival_schedules', 'arrival_schedules.arrival_station', 'arrival_schedules.train', 'arrival_schedules.operator');

        return $station;
    }
}
