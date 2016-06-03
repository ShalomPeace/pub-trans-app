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
}
