<?php 

namespace App\Repositories;

use App\Models\Operator;
use App\Repositories\Contracts\OperatorRepositoryInterface;

class OperatorRepository extends Repository implements OperatorRepositoryInterface
{
	public function __construct(Operator $model) 
	{
		$this->model = $model;
	}

	public function getOperatorList() 
	{
		return $this->model->active()
						   ->get();
	}

	public function getOperatorWithSchedules($id) 
	{
        $operator = $this->find($id);

        $operator->load('schedules', 'schedules.departure_station', 'schedules.arrival_station', 'schedules.train');

        return $operator;
	}
}
