<?php

namespace App\Models;

class Station extends BaseModel
{
    protected $guarded = ['id'];

    public $optionFields = ['id', 'name'];

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

    public function totalSchedules()
    {
        $departure = $this->departureSchedules()->count();
        $arrival   = $this->arrivalSchedules()->count();

        $total = $departure + $arrival;

        return $total;
    }

    public function formattedData() 
    {
        return [
            'id'    => $this->id, 
            'name'  => $this->name, 
            'active'    => $this->active, 
            'timestamps'    => [
                'created_at'    => $this->created_at->toDateTimeString(), 
                'updated_at'    => $this->created_at->toDateTimeString(),
            ]
        ];
    }
}
