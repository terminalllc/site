<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Proposal;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use App\Jobs\PowerOfAttorneyImport;
use App\Jobs\PowerOfAttorneyDelivery;

class Proposals extends Component
{
    #[Rule('required')]
    public $name_car;
    #[Rule('required|max:17')]
    public $vin_car;
    #[Rule('required')]
    public $model_tow_track;
    #[Rule('required')]
    public $number_tow_track;
    #[Rule('required')]
    public $number_trailer;
    #[Rule('required')]
    public $name_driver;
    #[Rule('required')]
    public $passport_driver;
    #[Rule('required')]
    public $phone_driver;
    #[Rule('required')]
    public $date_pick_up;

    public function render()
    {
        return view('livewire.proposals');
    }

    public function save()
    {
        $validated= $this->validate();

        $proposal = Proposal::create($validated);

        $this->reset();
        PowerOfAttorneyDelivery::dispatch($proposal);
        PowerOfAttorneyImport::dispatch($proposal);

        return redirect()->back()->withSuccess('Заявка збережена');
    }
}
