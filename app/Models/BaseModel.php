<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $boundToUser = true;

    public function isBoundToUser()
    {
        return $this->boundToUser;
    }
}
