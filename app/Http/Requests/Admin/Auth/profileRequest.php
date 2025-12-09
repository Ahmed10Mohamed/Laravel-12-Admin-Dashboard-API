<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

class profileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
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
             'email'     => 'required|unique:users,email,'.admin()->id.',id,deleted_at,NULL|email',
             'userName' => 'required|unique:users,userName,' . admin()->id . ',id,deleted_at,NULL',
             'phone'     => 'required|unique:users,phone,'.admin()->id.',id,deleted_at,NULL',
             'fullName'  => 'required|max:50',
             'image'     => 'nullable|image|mimes:jpg,jpeg,gif,png|max:800', // 800 KB max

        ];
    }
    public function messages(): array
    {
        return [
            'userName.required' => translate('The username field is required.'),
            'userName.unique'   => translate('This username is already taken.'),
            'userName.string'   => translate('The username must be a valid string.'),
            'userName.max'      => translate('The username must not exceed 50 characters.'),

            'email.required'     => translate('The email field is required.'),
            'email.unique'       => translate('This email is already in use.'),
            'email.email'        => translate('Please enter a valid email address.'),
            'email.max'          => translate('The email must not exceed 50 characters.'),

            'phone.required'     => translate('The phone number is required.'),
            'phone.unique'       => translate('This phone number is already in use.'),
            'phone.numeric'      => translate('The phone number must contain only numbers.'),
            'phone.max'          => translate('The phone number must not exceed 50 characters.'),

            'name.required'      => translate('The name field is required.'),
            'name.max'           => translate('The name must not exceed 50 characters.'),

            'image.image'        => translate('The uploaded file must be an image.'),
            'image.mimes'        => translate('Only JPG, GIF, and PNG images are allowed.'),
            'image.max'          => translate('The image must not be larger than 800KB.'),

        ];
    }

}
