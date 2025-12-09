<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class login_request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'phone' => [
                'required',
                'regex:/^\+20\d{10}$/', // Egyptian phone number format
            ],            
            'password' => 'required|string|min:8|regex:/^(?=.*[A-Z])(?=.*[\d\s\W]).{8,}$/',

        ];
    }

    public function messages()
    {
        return [

            'phone.required' => translate('Phone number is required'),
            'phone.regex' => translate('Phone number must start with +20 and contain 10 digits after the code'),
            
            'password.required' => translate('The password field is required.'),
            'password.string' => translate('The password must be a valid string.'),
            'password.min' => translate('The password must be at least 8 characters.'),
            'password.regex' => translate('The password must contain at least one uppercase letter and one number or special character.'),

        ];
    }
}
