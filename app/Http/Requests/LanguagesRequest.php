<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class LanguagesRequest extends FormRequest
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
            'name' => 'required|array|min:2',
            'name.*' => 'required|string|min:2',
            'code' => 'required|string',
            'encoding' => 'nullable|string',
            'image' => 'nullable|string',
            'is_default' => 'boolean',
            'status' => 'boolean',
        ];
    }

}
