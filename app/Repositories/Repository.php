<?php 

namespace App\Repositories;

use App\Models\BaseModel as Model;

abstract class Repository 
{
	protected $model;

	public function __construct(Model $model) 
	{
		$this->model = $model;
	}
}
