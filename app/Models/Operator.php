<?php

namespace App\Models;

class Operator extends BaseModel
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
    public $optionFields = ['id', 'first_name', 'last_name'];

    /**
     * The accessors to append to the model's array form.
     * 
     * @var array
     */
    protected $appends = ['full_name', 'route'];

    /**
     * Get the user that owns the operator.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Get the schedules for the operator.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function schedules()
    {
        return $this->hasMany(\App\Models\Schedule::class);
    }

    /**
     * Get the operator's full name.
     * 
     * @return bool
     */
    public function getFullNameAttribute()
    {
        return $this->attributes['full_name'] = ucwords($this->first_name . ' ' . $this->last_name);
    }
}
