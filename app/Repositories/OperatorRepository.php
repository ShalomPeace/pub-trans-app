<?php 

namespace App\Repositories;

use App\Models\Operator;
use App\Repositories\Contracts\OperatorRepositoryInterface;

class OperatorRepository extends Repository implements OperatorRepositoryInterface
{
	/**
	 * Constructor.
	 * 
	 * @param \App\Models\Operator $model
	 */
	public function __construct(Operator $model) 
	{
		$this->model = $model;
	}

	/**
	 * Get list of active operators.
	 * 
	 * @return Illuminate\Database\Eloquent\Collecton
	 */
	public function getOperatorList() 
	{
		return $this->model->active()
						   ->get();
	}

	/**
	 * Get operator by its primary key with list of schedules.
	 * 
	 * @param  string $id
	 * @return \App\Models\Operator
	 */
	public function getOperatorWithSchedules($id) 
	{
        $operator = $this->find($id);

        $operator->load('schedules', 'schedules.departure_station', 'schedules.arrival_station', 'schedules.train');

        return $operator;
	}
}
