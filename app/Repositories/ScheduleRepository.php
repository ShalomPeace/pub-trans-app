<?php

namespace App\Repositories;

use App\Models\Schedule;
use App\Repositories\Contracts\ScheduleRepositoryInterface;

class ScheduleRepository extends Repository implements ScheduleRepositoryInterface
{
    /**
     * Constructor
     * 
     * @param \App\Models\Schedule $model
     */
    public function __construct(Schedule $model)
    {
        $this->model = $model;
    }

    /**
     * Get latest departure and arrival schedules.
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getLatestSchedules() 
    {
        $today = date('Y-m-d');

        return $this->model->with('departure_station', 'arrival_station', 'train', 'operator')
                           ->where('departure_date', '>=', $today)
                           ->orWhere('arrival_date', '>=', $today)
                           ->get();
    }

    /**
     * Get schedule by its pimary key.
     * 
     * @param  int $id
     * @return \App\Models\Schedule
     */
    public function getSchedule($id) 
    {
        $schedule = $this->find($id);

        $schedule->load('departure_station', 'arrival_station', 'train', 'operator');

        return $schedule;
    }

    /**
     * Search schedule by station.
     * 
     * @param  int $from
     * @param  int $to
     * @return Illuminate\Database\Eloquent\Collection|null
     */
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
