<?php 

namespace App\Repositories\Contracts;

interface ScheduleRepositoryInterface
{
	public function getLatestSchedules();

    public function search($from, $to);
}