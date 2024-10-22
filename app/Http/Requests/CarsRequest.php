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
            'vin' => ['required','string','max:17', Rule::unique('cars')->ignore($this->route('car')),],
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
                if (Auth::user()->is_calculation_amount_at_general_rate) {

                    $this->merge([
                        'payment_summa' => ((int)$interval->days + 1) * Auth::user()->amount_for_parking_general + Auth::user()->amount_for_issuing_car,
                    ]);
                } else {
                    $count_days = (int)$interval->days + 1;
                    /* Log::info('count_days:' . $count_days); */
                    if ($count_days <= 7) {
                        $this->merge([
                            'payment_summa' => $count_days * Auth::user()->amount_for_parking_first_seven_days,
                        ]);
                    } else {

                        $amount_for_seven_days = ($count_days -1) * Auth::user()->amount_for_parking_first_seven_days;
                        $number_of_days_greater_than_seven = $count_days - 7;
                        $amount_for_greater_than_seven_days = $number_of_days_greater_than_seven * Auth::user()->amount_for_parking_general;
/*                         Log::info('amount_for_seven_days:' . $amount_for_seven_days);
                        Log::info('number_of_days_greater_than_seven:' . $number_of_days_greater_than_seven);
                        Log::info('amount_for_greater_than_seven_days:' . $amount_for_greater_than_seven_days);
                        Log::info('amount:' . $amount_for_seven_days + $amount_for_greater_than_seven_days); */
                        $this->merge([
                            'payment_summa' => $amount_for_seven_days + $amount_for_greater_than_seven_days,
                        ]);
                    }
                }
            }
        }

        $this->merge([
            'client_id' => data_get($this->client_id, 'id'),
        ]);
    }
}
