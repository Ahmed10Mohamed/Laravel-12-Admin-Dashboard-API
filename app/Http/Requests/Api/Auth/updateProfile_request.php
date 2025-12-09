<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class updateProfile_request extends FormRequest
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
            'phone' => ['required', 'regex:/^\+20\d{10}$/', 'unique:users,phone,'.api()->id], // يبدأ بـ +971
            'email' => 'nullable|email|unique:users,email,'.api()->id,
            'userName' => 'required|unique:users,userName,'.api()->id,
            'image' => 'nullable|mimetypes:image/jpeg,image/png,image/gif,image/bmp,image/svg+xml,image/webp,image/x-icon|max:5120',

        ];
    }

    public function messages()
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

            'image.mimetypes' => translate('The image must be a valid image type (jpeg, png, gif, bmp, svg, webp, x-icon)'),
            'image.max' => translate('The image may not be greater than 5MB'),
        ];
    }
}
