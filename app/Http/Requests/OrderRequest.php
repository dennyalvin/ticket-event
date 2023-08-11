<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'email' => 'required|min:5|max:50|email',
            'payment_method' => 'required|min:5|max:30',
            'cc_no' => 'required|min:5|max:30',
            'cc_name' => 'required|min:3|max:100',
            'cc_exp_month' => 'required|min:2|max:2',
            'cc_exp_year' => 'required|min:2|max:2',
            'cc_cvc' => 'required|min:3|max:3',
        ];
    }
}
