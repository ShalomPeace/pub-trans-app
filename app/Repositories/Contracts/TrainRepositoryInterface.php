<?php

namespace App\Repositories\Contracts;

interface TrainRepositoryInterface 
{
	public function getTrainList();

	public function getTrainWithSchedules($id);

	public function getNextCode();
}
