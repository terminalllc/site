<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'logo' => 'required|string',
            'address' => 'required|array|min:2',
            'address.*' => 'required|string|min:2',
            'phone' => 'required|min:10',
            'phone_driver' => 'required|min:10',
            'email' => 'required|email',
            'google_map_link' => 'required|string|active_url',
            'video' => 'required|string',
        ];
    }

}
