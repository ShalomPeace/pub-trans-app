<?php

namespace App\Models;

class Operator extends BaseModel
{
    protected $guarded = ['id'];

    protected $optionFields = ['id', 'first_name', 'last_name'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function schedules()
    {
        return $this->hasMany(\App\Models\Schedule::class);
    }

    public function name()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function formattedData() 
    {
        return [
            'id'    => $this->id, 
            'first_name' => $this->first_name, 
            'last_name' => $this->last_name, 
            'timestamps'    => $this->getTimestamps(), 
        ];
    }
}
