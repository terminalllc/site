<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:25'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($this->route('user'))],
            'password' => ['nullable'],
            'role' => ['required', Rule::in(['admin', 'partner']),],
            'is_calculation_amount_at_general_rate' => ['required', 'boolean'],
            'amount_for_parking_first_seven_days' => [Rule::requiredIf(!$this->is_calculation_amount_at_general_rate)],
            'amount_for_parking_general' => ['required'],
            'amount_for_issuing_car' => [Rule::requiredIf($this->is_calculation_amount_at_general_rate)],

        ];
    }
    public function messages()
    {
        return [
            'required' => ':Attribute required',

        ];
    }
}
