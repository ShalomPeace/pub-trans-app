<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
	/**
	 * Find a model by its primary key.
	 * 
	 * @param  int $id
	 * @return \Illuminate\Database\Eloquent\Model
	 */
    public function find($id);

    /**
     * Retrieve all data from the table
     * 
     * @return Illuminate\Database\Eloquent\Collecton
     */
    public function getAll();

    /**
     * 
     * Save a new model and return the instance.
     *
     * @param  array  $data
     * @return static
     */
    public function create(array $data);

    /**
     * Update the model in the database.
     *
     * @param  int    $id
     * @param  array  $data
     * @return bool|int
     */
    public function update($id, array $data);
}
