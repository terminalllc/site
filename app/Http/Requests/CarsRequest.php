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
            'out_terminal_at' => 'nullable|date|after_or_equal:on_terminal_at',
            'comment' => 'nullable|string',
            'status' => 'boolean',
            'client_id' => 'nullable|exists:clients,id',
            'payment_summa' => 'nullable|numeric',
            'user_clicked_payment_status' => 'nullable|string',
            'payment_status' => 'boolean',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if (!$this->payment_status) {

            if ($this->out_terminal_at && $this->on_terminal_at) {

                $date1 = new \DateTime($this->out_terminal_at);
                $date2 = new \DateTime($this->on_terminal_at);
                $interval = $date1->diff($date2);
                $this->merge([
                    'payment_summa' => ((int)$interval->days + 1)*200 +800 ,
                ]);
            }
        }

        $this->merge([
            'client_id' => data_get($this->client_id, 'id'),
        ]);
    }
}
