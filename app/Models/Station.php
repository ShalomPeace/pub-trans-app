<?php

namespace App\Models;

class Station extends BaseModel
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function departureSchedules()
    {
        return $this->hasMany(\App\Models\Schedule::class, 'departure_station_id');
    }

    public function arrivalSchedules()
    {
        return $this->hasMany(\App\Models\Schedule::class, 'arrival_station_id');
    }
}
