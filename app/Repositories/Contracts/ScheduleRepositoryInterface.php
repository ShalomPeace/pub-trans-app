<?php 

namespace App\Repositories\Contracts;

interface ScheduleRepositoryInterface
{
    public function search($from, $to);
}