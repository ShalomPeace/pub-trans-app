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

    public function getLatestSchedules() 
    {
        $today = date('Y-m-d');

        return $this->model->where('departure_date', '>=', $today)
                           ->orWhere('arrival_date', '>=', $today)
                               ->get();
    }

    public function search($departure, $arrival)
    {
        $query = $this->model;

        if ($departure) {
            $query = $query->where('departure_station_id', $departure);
        }

        if ($arrival) {
            $query = $query->where('arrival_station_id', $arrival);
        }

        $results = $query->get();

        return $this->getFormattedData($results);
    }
}
