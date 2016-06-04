<?php

namespace App\Models;

class Train extends BaseModel
{
	protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function schedules()
    {
        return $this->hasMany(\App\Models\Schedule::class);
    }

    public function totalSeats()
    {
        return number_format($this->total_seats) . ' seats';
    }
}
