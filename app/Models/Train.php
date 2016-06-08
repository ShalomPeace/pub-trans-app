<?php

namespace App\Models;

class Train extends BaseModel
{
	protected $guarded = ['id'];

    protected $optionFields = ['id', 'name'];

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

    public function formattedData() 
    {
        return [
            'id'    => $this->id, 
            'code'  => $this->code, 
            'name'  => $this->name, 
            'total_seats'   => $this->total_seats, 
            'active'        => $this->active, 
            'timestamps'    => [
                'created_at'    => $this->created_at->toDateTimeString(), 
                'updated_at'    => $this->updated_at->toDateTimeString(),
            ],
        ];
    }
}
