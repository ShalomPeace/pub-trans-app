<?php

namespace App\Models;

class Station extends BaseModel
{
    protected $guarded = ['id'];

    public $optionFields = ['id', 'name'];

    protected $appends = ['total_schedule', 'route'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function departure_schedules()
    {
        return $this->hasMany(\App\Models\Schedule::class, 'departure_station_id');
    }

    public function arrival_schedules()
    {
        return $this->hasMany(\App\Models\Schedule::class, 'arrival_station_id');
    }

    public function getTotalScheduleAttribute()
    {
        $departure = $this->departureSchedules()->count();
        $arrival   = $this->arrivalSchedules()->count();

        $total = $departure + $arrival;

        return $this->attributes['total_schedule'] = $total;
    }
}
