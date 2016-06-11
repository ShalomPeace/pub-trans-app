<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $boundToUser = true;

    protected $activeField = 'active';

    protected $routeKey;

    public function scopeActive($query, $active = 1) 
    {
    	return $query->where($this->activeField, $active);
    }

    public function isBoundToUser()
    {
        return $this->boundToUser;
    }

    public function getRouteAttribute() 
    {
        $routeKey = $this->getRouteKey();

        $routes = [
            'show'      => route("{$routeKey}.show", $this), 
            'edit'      => route("{$routeKey}.edit", $this), 
            'update'    => route("{$routeKey}.update", $this),
        ];

        return $this->attributes['routes'] = $routes;
    }

    private function getRouteKey() 
    {
        return $this->routeKey ? $this->routeKey : str_plural(strtolower(get_class($this)), $count = 2);
    }
}
