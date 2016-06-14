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

        return $this->model->with('departure_station', 'arrival_station', 'train', 'operator')
                           ->where('departure_date', '>=', $today)
                           ->orWhere('arrival_date', '>=', $today)
                           ->get();
    }

    public function getSchedule($id) 
    {
        $schedule = $this->find($id);

        $schedule->load('departure_station', 'arrival_station', 'train', 'operator');

        return $schedule;
    }

    public function search($departure, $arrival)
    {
        $query = $this->model->with('departure_station', 'arrival_station', 'train', 'operator');

        if ($departure) {
            $query = $query->where('departure_station_id', $departure);
        }

        if ($arrival) {
            $query = $query->where('arrival_station_id', $arrival);
        }

        $results = $query->get();

        return ! $results->isEmpty() ? $results : [];
    }
}
