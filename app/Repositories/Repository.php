<?php 

namespace App\Repositories;

use App\Models\BaseModel as Model;
use App\Repositories\Contracts\RepositoryInterface;

use Illuminate\Database\Eloquent\Collection;

abstract class Repository implements RepositoryInterface
{
    /**
     * The model used by the repository
     * 
     * @var [type]
     */
	protected $model;

    /**
     * Constructor
     * 
     * @param App\Models\BaseModel
     */
	public function __construct(Model $model) 
	{
		$this->model = $model;
	}

    /**
     * Find a model by its primary key.
     * 
     * @param  int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Retrieve all data from the table
     * 
     * @return Illuminate\Database\Eloquent\Collecton
     */
    public function getAll($with = [])
    {
        if ($this->model->isBoundToUser()) {
            $with[] = 'user';

            return $this->model->with($with)->get();
        }

        return $this->model->all();
    }

    /**
     * 
     * Save a new model and return the instance.
     *
     * @param  array  $data
     * @return static
     */
    public function create(array $data)
    {
        if ($this->model->isBoundToUser()) {
            $data = $this->addUser($data);
        }

        return $this->model->create($data);
    }

    /**
     * Update the model in the database.
     *
     * @param  int    $id
     * @param  array  $data
     * @return bool|int
     */
    public function update($id, array $data)
    {
        $model = $this->model->find($id);

        if ( ! $model) return false;

        $model->update($data);

        return true;
    }

    /**
     * Bind user_id to model's attributes
     * 
     * @param array $data
     */
    private function addUser(array $data)
    {
        $data['user_id'] = auth()->user()->id;

        return $data;
    }

    /**
     * Get data for dropdown list
     * 
     * @return Illuminate\Database\Eloquent\Collecton
     */
    public function getForField() 
    {
        return $this->model->get($this->model->optionFields);
    }
}
