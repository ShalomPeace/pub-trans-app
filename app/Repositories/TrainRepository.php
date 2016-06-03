<?php

namespace App\Repositories;

use App\Models\Train;
use App\Repositories\Contracts\TrainRepositoryInterface;

class TrainRepository extends Repository implements TrainRepositoryInterface
{
    public function __construct(Train $model)
    {
        $this->model = $model;
    }
}
