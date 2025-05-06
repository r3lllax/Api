<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LunarMissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

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
            'mission.landing_details'=>'required',
            'mission.spacecraft'=>'required',
        ];
    }
}
