<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'account_name' =>['required','string','min:3'],
            'opening_balance' =>['required','integer','min:0'],
            'descriptions' =>['nullable'],
        ];
    }

    public function messages():array
    {
        return [
            'account_user.required' => 'You need to fill acount name !',
            'account_user.min' => 'Account name must be at least 3 characters',
            'openning_balance.number' => 'The amount must be integer',
            'accepted_amount.required' => 'The amount must be filled',
        ];
    }
}