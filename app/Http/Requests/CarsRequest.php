<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
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
            'vin' => ['required', 'string', 'max:17', Rule::unique('cars')->ignore($this->route('car')),],
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

                // количество дней
                $days = $this->out_terminal_at === $this->on_terminal_at
                    ? 1
                    : (int)$interval->days;

                switch (true) {
                    case ($days <= 1):
                        $this->merge([
                            'payment_summa' => Auth::user()->rate_14
                                + Auth::user()->rate_one_time,
                        ]);
                        break;
                    case ($days <= 14):
                        $this->merge([
                            'payment_summa' => $days
                                * Auth::user()->rate_14
                                + Auth::user()->rate_one_time,
                        ]);
                        break;
                    case ($days <= 30):
                        $rest_day = $days - 14;
                        $this->merge([
                            'payment_summa' =>
                            (14 * Auth::user()->rate_14)
                            + ($rest_day * Auth::user()->rate_30)
                            + Auth::user()->rate_one_time,
                        ]);
                        break;
                    case ($days <= 60):
                        $rest_day = $days - 30;
                        $this->merge([
                            'payment_summa' => (14 * Auth::user()->rate_14)
                                + (16 * Auth::user()->rate_30)
                                + ($rest_day * Auth::user()->rate_60)
                                + Auth::user()->rate_one_time,
                        ]);
                        break;
                    default:
                        $rest_day = $days - 60;
                        $this->merge([
                            'payment_summa' => (14 * Auth::user()->rate_14)
                                + (16 * Auth::user()->rate_30)
                                + (30 * Auth::user()->rate_60)
                                + ($rest_day * Auth::user()->rate_other)
                                + Auth::user()->rate_one_time,
                        ]);
                        break;
                }
            }
        }

        $this->merge([
            'client_id' => data_get($this->client_id, 'id'),
        ]);
    }
}
