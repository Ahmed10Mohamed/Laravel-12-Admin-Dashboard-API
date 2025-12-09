<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class changeAccountRequest extends FormRequest
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
            'userName' => 'required|exists:users,userName',
        ];
    }

    public function messages(): array
    {
        return [
            'userName.required' => translate('User name is required'),
            'userName.exists' => translate('This user name not correct'),

        ];
    }
}
