<?php

namespace App\Repositories\Contracts;

interface TrainRepositoryInterface 
{
	/**
	 * Get list of active trains.
	 * 
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function getTrainList();

	/**
	 * Get train by its primary key with list of schedules.
	 * 
	 * @param  int $id
	 * @return \App\Models\Train    
	 */
	public function getTrainWithSchedules($id);

	/**
	 * Get incremented code for new train.
	 * 
	 * @return string
	 */
	public function getNextCode();
}
