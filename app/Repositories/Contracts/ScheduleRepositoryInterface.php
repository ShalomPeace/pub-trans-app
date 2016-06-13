<?php 

namespace App\Repositories\Contracts;

interface ScheduleRepositoryInterface
{
	public function getLatestSchedules();

	public function getSchedule($id);

    public function search($from, $to);
}