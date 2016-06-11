<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $boundToUser = true;

    protected $activeField = 'active';

    protected $routeName;

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
        $route = $this->getRouteName();

        $routes = [
            'show'      => route("{$route}.show", $this), 
            'edit'      => route("{$route}.edit", $this), 
            'update'    => route("{$route}.update", $this),
        ];

        return $this->attributes['routes'] = $routes;
    }

    private function getRouteName() 
    {
        return $this->routeName ? $this->routeName : str_plural(strtolower(class_basename($this)));
    }
}
