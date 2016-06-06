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

    public function search($from, $to)
    {
        $result = $this->model->where('departure_station_id', $from)
                              ->where('arrival_station_id', $to)
                              ->get();

        return $result;
    }
}
