<?php 

namespace App\Repositories\Contracts;

interface OperatorRepositoryInterface 
{
	/**
	 * Get list of active operators.
	 * 
	 * @return Illuminate\Database\Eloquent\Collecton
	 */
	public function getOperatorList();

	/**
	 * Get operator by its primary key with list of schedules.
	 * 
	 * @param  string $id
	 * @return \App\Models\Operator
	 */
	public function getOperatorWithSchedules($id);
}
