<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class CalculationsRequest extends FormRequest
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
            'rate_14' => 'required|numeric',
            'rate_30' => 'required|numeric',
            'rate_60' => 'required|numeric',
            'rate_other' => 'required|numeric',
            'rate_one_time' => 'required|numeric',
        ];
    }
}

