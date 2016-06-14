<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * Determines if the model is connected to user.
     * 
     * @var boolean
     */
    protected $boundToUser = true;

    /**
     * Field name for active state.
     * 
     * @var string
     */
    protected $activeField = 'active';

    /**
     * Model's route name
     * 
     * @var string
     */
    protected $routeName;

    /**
     * Scope a query to only include active models.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  integer $active
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query, $active = 1) 
    {
    	return $query->where($this->activeField, $active);
    }

    /**
     * Check if the model is connected to user.
     * 
     * @return boolean
     */
    public function isBoundToUser()
    {
        return $this->boundToUser;
    }

    /**
     * Get the model's created_at timestamp.
     * 
     * @param  string $value
     * @return string
     */
    public function getCreatedAtAttribute($value) 
    {
        return date('F j, Y', strtotime($value));
    }

    /**
     * Get route links for the model.
     * 
     * @return bool
     */
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

    /**
     * Get route name by class name.
     * 
     * @return string
     */
    private function getRouteName() 
    {
        return $this->routeName ? $this->routeName : str_plural(strtolower(class_basename($this)));
    }
}
