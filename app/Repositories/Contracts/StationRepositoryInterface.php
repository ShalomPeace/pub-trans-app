<?php

namespace App\Repositories\Contracts;

interface StationRepositoryInterface 
{
	/**
	 * Get station with departure and arrival schedules.
	 * 
	 * @return Illuminate\Database\Eloquent\Collection|null
	 */
	public function getStationsWithSchedules();

	/**
	 * Get station by its primary key and  
	 * 
	 * @param  integer $id
	 * @return \App\Models\Station
	 */
	public function getStationWithSchedules($id);
}
