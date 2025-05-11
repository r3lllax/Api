<?php

namespace App\Http\Requests;

use App\Rules\FirstLetterRule;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name'=>['required','string','max:255',new FirstLetterRule()],
            'last_name'=>['required','string','max:255',new FirstLetterRule()],
            'patronymic'=>['required','string','max:255',new FirstLetterRule()],
            'email'=>'required|string|email|max:255|unique:users,email',
            'password'=>'required|string|min:3|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{3,}$/u',
            'birth_date'=>'required|string|max:255',
        ];
    }
}
