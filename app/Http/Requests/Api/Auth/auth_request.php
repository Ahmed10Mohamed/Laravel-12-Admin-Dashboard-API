<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class auth_request extends FormRequest
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
            'fullName' => 'required',
            'userName' => 'required|unique:users',
            'phone' => [
                'required',
                'regex:/^\+20\d{10}$/', // Egyptian phone number format
                'unique:users,phone'
            ],
            'email' => 'nullable|email|unique:users,email',
            'password' => 'required|confirmed|string|min:8|regex:/^(?=.*[A-Z])(?=.*[\d\s\W]).{8,}$/',
            'image' => 'nullable|mimetypes:image/jpeg,image/png,image/gif,image/bmp,image/svg+xml,image/webp,image/x-icon|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'fullName.required' => translate('Full name is required'),
            'userName.required' => translate('User name is required'),
            'userName.unique' => translate('This user name is already taken'),

            'phone.required' => translate('Phone number is required'),
            'phone.regex' => translate('Phone number must start with +20 and contain 10 digits after the code'),
            'phone.unique' => translate('This phone number is already taken'),

            'email.email' => translate('Please enter a valid email address'),
            'email.unique' => translate('This email address is already taken'),

            'password.required' => translate('The password field is required.'),
            'password.confirmed' => translate('The password confirmation does not match.'),
            'password.string' => translate('The password must be a valid string.'),
            'password.min' => translate('The password must be at least 8 characters.'),
            'password.regex' => translate('The password must contain at least one uppercase letter and one number or special character.'),

            'image.mimetypes' => translate('The image must be a valid image type (jpeg, png, gif, bmp, svg, webp, x-icon)'),
            'image.max' => translate('The image may not be greater than 5MB'),
        ];
    }
}
