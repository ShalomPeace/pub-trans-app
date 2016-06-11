<?php

namespace App\Models;

class Train extends BaseModel
{
	protected $guarded = ['id'];

    public $optionFields = ['id', 'name'];

    protected $appends = ['route'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function schedules()
    {
        return $this->hasMany(\App\Models\Schedule::class);
    }

    public function getTotalSeatsAttribute($value)
    {
        return number_format($value) . ' seats';
    }
}
