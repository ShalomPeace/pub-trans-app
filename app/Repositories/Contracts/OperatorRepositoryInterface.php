<?php 

namespace App\Repositories\Contracts;

interface OperatorRepositoryInterface 
{
	public function getOperatorList();

	public function getOperatorWithSchedules($id);
}
