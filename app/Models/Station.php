<?php

namespace App\Models;

class Station extends BaseModel
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Field names used for select dropdown.
     * 
     * @var array
     */
    public $optionFields = ['id', 'name'];

    /**
     * The accessors to append to the model's array form.
     * 
     * @var array
     */
    protected $appends = ['total_schedule', 'route'];

    /**
     * Get the user that owns the station.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Get the departure schedules for the station.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departure_schedules()
    {
        return $this->hasMany(\App\Models\Schedule::class, 'departure_station_id');
    }

    /**
     * Get the arrival schedules for the station.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function arrival_schedules()
    {
        return $this->hasMany(\App\Models\Schedule::class, 'arrival_station_id');
    }

    /**
     * Get the total number of schedules.
     * 
     * @return bool
     */
    public function getTotalScheduleAttribute()
    {
        $departure = $this->departure_schedules->count();
        $arrival   = $this->arrival_schedules->count();

        $total = $departure + $arrival;

        return $this->attributes['total_schedule'] = $total;
    }
}
