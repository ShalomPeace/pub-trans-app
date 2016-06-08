<?php

namespace App\Repositories;

use App\Models\Schedule;
use App\Repositories\Contracts\ScheduleRepositoryInterface;

class ScheduleRepository extends Repository implements ScheduleRepositoryInterface
{
    public function __construct(Schedule $model)
    {
        $this->model = $model;
    }

    public function getSchedules() 
    {
        $today = date('Y-m-d');

        $results = $this->model->where('departure_date', '>=', $today)
                               ->orWhere('arrival_date', '<=', $today)
                               ->get();

        return $this->getFormattedData($results);
    }

    public function search($departure, $arrival)
    {
        $results = $this->model->where('departure_station_id', $departure)
                              ->orWhere('arrival_station_id', $arrival)
                              ->get();

        return $this->getFormattedData($results);
    }
}
