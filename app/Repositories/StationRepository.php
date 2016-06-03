<?php

namespace App\Repositories;

use App\Models\Station;
use App\Repositories\Contracts\StationRepositoryInterface;

class StationRepository extends Repository implements StationRepositoryInterface
{
    public function __construct(Station $model)
    {
        $this->model = $model;
    }
}
