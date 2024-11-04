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
            
        ];
    }
    public function messages()
    {
        return [
            'required' => ':Attribute required',

        ];
    }
}
