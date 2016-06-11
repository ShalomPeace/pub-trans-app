<?php

namespace App\Models;

use DateTime;

class Schedule extends BaseModel
{
    protected $guarded = ['id'];

    protected $appends = [
        'duration', 
        'departure_date_time', 
        'arrival_date_time',
        'route',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function train()
    {
        return $this->belongsTo(\App\Models\Train::class);
    }

    public function departure_station()
    {
        return $this->belongsTo(\App\Models\Station::class, 'departure_station_id');
    }

    public function arrival_station()
    {
        return $this->belongsTo(\App\Models\Station::class, 'arrival_station_id');
    }

    public function operator()
    {
        return $this->belongsTo(\App\Models\Operator::class);
    }

    public function getDepartureDateTimeAttribute()
    {
        return $this->attributes['departure_date_time'] = $this->dateTime($this->departure_date, $this->departure_time);
    }

    public function getArrivalDateTimeAttribute()
    {
        return $this->attributes['arrival_date_time'] = $this->dateTime($this->arrival_date, $this->arrival_time);
    }

    public function getDurationAttribute()
    {
        $interval = $this->calculateDuration();

        $duration = '';

        if ($interval->y) { $duration .= $interval->format("%y years "); }
        if ($interval->m) { $duration .= $interval->format("%m months "); }
        if ($interval->d) { $duration .= $interval->format("%d days "); }
        if ($interval->h) { $duration .= $interval->format("%h hours "); }
        if ($interval->i) { $duration .= $interval->format("%i minutes "); }
        if ($interval->s) { $duration .= $interval->format("%s seconds "); }

        return $this->attributes['duration'] = $duration;
    }

    public function dateTime($date, $time)
    {
        return date('F j, Y @ H:i a', strtotime("{$date} {$time}"));
    }

    private function calculateDuration()
    {
        $departure = new DateTime("{$this->departure_date} {$this->departure_time}");
        $arrival   = new DateTime("{$this->arrival_date} {$this->arrival_time}");

        return $departure->diff($arrival);
    }
}
