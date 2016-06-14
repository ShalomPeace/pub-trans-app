<?php

namespace App\Models;

class Train extends BaseModel
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
    protected $appends = ['total_seats_text', 'route'];

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
     * Get the schedules for the train.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function schedules()
    {
        return $this->hasMany(\App\Models\Schedule::class);
    }

    /**
     * Get total number of seats.
     * 
     * @return bool
     */
    public function getTotalSeatsTextAttribute() 
    {
        return $this->attributes['total_seats_text'] = number_format($this->total_seats) . ' seats';
    }
}
