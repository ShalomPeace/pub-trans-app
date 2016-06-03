<?php 

namespace App\Repositories;

use App\Models\BaseModel as Model;
use App\Repositories\Contracts\RepositoryInterface;

abstract class Repository implements RepositoryInterface
{
	protected $model;

	public function __construct(Model $model) 
	{
		$this->model = $model;
	}

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function getAll($with = [])
    {
        if ($this->model->isBoundToUser()) {
            $with[] = 'user';

            return $this->model->with($with)->get();
        }

        return $this->model->all();
    }

    public function create(array $data)
    {
        if ($this->model->isBoundToUser()) {
            $data = $this->addUser($data);
        }

        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $model = $this->model->find($id);

        if ( ! $model) return false;

        $model->update($data);

        return true;
    }

    private function addUser(array $data)
    {
        $data['user_id'] = auth()->user()->id;

        return $data;
    }
}
