<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function find($id);

    public function getAll();

    public function create(array $data);

    public function update($id, array $data);
}
