<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $boundToUser = true;

    protected $activeField = 'active';

    public function scopeActive($query, $active = 1) 
    {
    	return $query->where($this->activeField, $active);
    }

    public function isBoundToUser()
    {
        return $this->boundToUser;
    }

    protected function getTImestamps() 
    {
        return [
            'created_at'    => $this->created_at->toDateTimeString(), 
            'updated_at'    => $this->updated_at->toDateTimeString(),
        ];
    }
}
