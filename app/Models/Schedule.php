<?php

namespace App\Models;

use DateTime;

class Schedule extends BaseModel
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function train()
    {
        return $this->belongsTo(\App\Models\Train::class);
    }

    public function departureStation()
    {
        return $this->belongsTo(\App\Models\Station::class, 'departure_station_id');
    }

    public function arrivalStation()
    {
        return $this->belongsTo(\App\Models\Station::class, 'arrival_station_id');
    }

    public function operator()
    {
        return $this->belongsTo(\App\Models\Operator::class);
    }

    public function departureDateTime($format = 'F j, Y @ H:i a')
    {
        return $this->dateTime($format, $this->departure_date, $this->departure_time);
    }

    public function arrivalDateTime($format = 'F j, Y @ H:i a')
    {
        return $this->dateTime($format, $this->arrival_date, $this->arrival_time);
    }

    public function dateTime($format, $date, $time)
    {
        return date($format, strtotime("{$date} {$time}"));
    }

    public function duration()
    {
        $interval = $this->calculateDuration();

        $duration = '';

        if ($interval->y) { $duration .= $interval->format("%y years "); }
        if ($interval->m) { $duration .= $interval->format("%m months "); }
        if ($interval->d) { $duration .= $interval->format("%d days "); }
        if ($interval->h) { $duration .= $interval->format("%h hours "); }
        if ($interval->i) { $duration .= $interval->format("%i minutes "); }
        if ($interval->s) { $duration .= $interval->format("%s seconds "); }

        return $duration;
    }

    private function calculateDuration()
    {
        $departure = new DateTime("{$this->departure_date} {$this->departure_time}");
        $arrival   = new DateTime("{$this->arrival_date} {$this->arrival_time}");

        return $departure->diff($arrival);
    }

    public function formattedData() 
    {
        return [
            'id'    => $this->id, 
            'train' => $this->train->formattedData(), 
            'departure'     => [
                'station'   => $this->departureStation->formattedData(), 
                'date'      => $this->departure_date, 
                'time'      => $this->departure_time, 
                'formatted_date_time'   => $this->departureDateTime(), 
            ],
            'arrival'     => [
                'station'   => $this->arrivalStation->formattedData(), 
                'date'      => $this->arrival_date, 
                'time'      => $this->arrival_time, 
                'formatted_date_time'   => $this->arrivalDateTime(), 
            ],
            'duration'      => $this->duration(),
            'operator'  => $this->operator->formattedData(),
            'timestamps'    => $this->getTimestamps(), 
        ];
    }
}
