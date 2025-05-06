<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LunarMissionRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'mission'=>'required',
            'mission.name'=>'string|required|max:255',
            'mission.launch_details'=>'required',
            'mission.launch_details.launch_date'=>'required|date_format:Y-m-d',
            'mission.launch_details.launch_site'=>'required|',
            'mission.launch_details.launch_site.name'=>'required|string|max:255',
            'mission.launch_details.launch_site.location'=>'required',
            'mission.launch_details.launch_site.location.latitude'=>'required',
            'mission.launch_details.launch_site.location.longitude'=>'required',
            'mission.landing_details'=>'required',
            'mission.landing_details.landing_date'=>'required|date_format:Y-m-d',
            'mission.landing_details.landing_site'=>'required',
            'mission.landing_details.landing_site.name'=>'required|string|max:255',
            'mission.landing_details.landing_site.coordinates'=>'required',
            'mission.landing_details.landing_site.coordinates.latitude'=>'required',
            'mission.landing_details.landing_site.coordinates.longitude'=>'required',

            'mission.spacecraft'=>'required',
            'mission.spacecraft.command_module'=>'string|required|max:255',
            'mission.spacecraft.lunar_module'=>'string|required|max:255',
            'mission.spacecraft.crew'=>'required|array',
            'mission.spacecraft.crew.*.name'=>'string|required|max:255',
            'mission.spacecraft.crew.*.role'=>'string|required|max:255',
        ];
    }
}
