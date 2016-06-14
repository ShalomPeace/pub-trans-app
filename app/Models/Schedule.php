<?php

namespace App\Models;

use DateTime;

class Schedule extends BaseModel
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The accessors to append to the model's array form.
     * 
     * @var array
     */
    protected $appends = [
        'duration', 
        'departure_date_time', 
        'arrival_date_time',
        'route',
    ];

    /**
     * Get the user that owns the schedule.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Get the train that is assigned to the schedule.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function train()
    {
        return $this->belongsTo(\App\Models\Train::class);
    }

    /**
     * Get the departure station.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departure_station()
    {
        return $this->belongsTo(\App\Models\Station::class, 'departure_station_id');
    }

    /**
     * Get the arrival station.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function arrival_station()
    {
        return $this->belongsTo(\App\Models\Station::class, 'arrival_station_id');
    }

    /**
     * Get the operator that is assigned for the schedule.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function operator()
    {
        return $this->belongsTo(\App\Models\Operator::class);
    }

    /**
     * Get departure date and time.
     * 
     * @return bool
     */
    public function getDepartureDateTimeAttribute()
    {
        return $this->attributes['departure_date_time'] = $this->dateTime($this->departure_date, $this->departure_time);
    }

    /**
     * Get the arrival date and time.
     * 
     * @return bool
     */
    public function getArrivalDateTimeAttribute()
    {
        return $this->attributes['arrival_date_time'] = $this->dateTime($this->arrival_date, $this->arrival_time);
    }

    /**
     * Get duration.
     * 
     * @return bool
     */
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

    /**
     * Date and time formatter.
     * 
     * @param  string $date
     * @param  string $time
     * @return string
     */
    public function dateTime($date, $time)
    {
        return date('F j, Y @ H:i a', strtotime("{$date} {$time}"));
    }

    /**
     * Get the difference from departure date and time to arrival date and time.
     * 
     * @return DateInterval
     */
    private function calculateDuration()
    {
        $departure = new DateTime("{$this->departure_date} {$this->departure_time}");
        $arrival   = new DateTime("{$this->arrival_date} {$this->arrival_time}");

        return $departure->diff($arrival);
    }
}
