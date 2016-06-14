<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ScheduleFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'train_id'              => 'required',
            'departure_station_id'  => 'required',
            'arrival_station_id'    => 'required',
            'departure_date'        => 'required',
            'departure_time'        => 'required',
            'arrival_date'          => 'required',
            'arrival_time'          => 'required',
            'operator_id'           => 'required',
        ];
    }
}
