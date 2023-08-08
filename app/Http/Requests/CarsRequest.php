<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class CarsRequest extends FormRequest
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
            'vin' => 'required|string|max:17',
            'containerImages' => 'nullable|array',
            'containerImages.*' => 'required',
            'terminalImages' => 'nullable|array',
            'terminalImages.*' => 'required',
            'outImages' => 'nullable|array',
            'outImages.*' => 'required',
            'on_terminal_at' => 'date',
            'out_terminal_at' => 'nullable|date',
            'status' => 'boolean',
        ];
    }
}
