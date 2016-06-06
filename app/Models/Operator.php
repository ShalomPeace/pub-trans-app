<?php

namespace App\Models;

class Operator extends BaseModel
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

    public function name()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
