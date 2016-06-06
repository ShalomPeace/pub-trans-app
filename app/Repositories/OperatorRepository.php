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
}
