<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|max:50|min:3',
            'last_name' => 'max:50',
            'phone' => 'required|min:5|max:20',
            'email' => 'required|min:5|max:50|email|unique:users',
            'password' => 'required|min:5|max:50'
        ];
    }
}
