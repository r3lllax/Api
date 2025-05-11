<?php

namespace App\Http\Requests;

use App\Rules\FirstLetterRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SpaceFlightRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'flight_number'=>['required','max:255',
                function ($attribute,$value,$fail) {
                    if(mb_strtoupper($value)!=$value){
                        $fail('All field letters must be upper');
                    }
                }],
            'destination'=>['required','max:255',new FirstLetterRule()],
            'launch_date'=>'required|max:255|date_format:Y-m-d',
            'seats_available'=>'required|numeric|min:1',
        ];
    }
}
