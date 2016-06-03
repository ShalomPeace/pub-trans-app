<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function train()
    {
        return $this->hasOne(\App\Models\Train::class);
    }

    public function departureStation()
    {
        return $this->hasOne(\App\Models\Station::class, 'departure_station_id');
    }

    public function arrivalStation()
    {
        return $this->hasOne(\App\Models\Station::class, 'arrival_station_id');
    }

    public function operator()
    {
        return $this->hasOne(\App\Models\Operator::class);
    }
}
