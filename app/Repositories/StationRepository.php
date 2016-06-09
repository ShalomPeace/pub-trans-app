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
    					   ->with('departureschedules', 'arrivalschedules')
    					   ->get();
    }
}
