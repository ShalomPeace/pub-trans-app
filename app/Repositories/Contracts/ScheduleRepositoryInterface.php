<?php 

namespace App\Repositories\Contracts;

interface ScheduleRepositoryInterface
{
	/**
	 * Get latest departure and arrival schedules.
	 * 
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function getLatestSchedules();

	/**
	 * Get schedule by its pimary key.
	 * 
	 * @param  int $id
	 * @return \App\Models\Schedule
	 */
	public function getSchedule($id);

	/**
	 * Search schedule by station.
	 * 
	 * @param  int $from
	 * @param  int $to
	 * @return Illuminate\Database\Eloquent\Collection|null
	 */
    public function search($from, $to);
}