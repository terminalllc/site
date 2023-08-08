<?php

namespace App\Livewire;

use App\Models\Car;
use Livewire\Component;

class Search extends Component
{
    public $search;
    public $query;

    public function updatedSearch()
    {
        $this->query = strlen($this->search) >5 ? $this->search : null;

    }

    public function render()
    {
        if ($this->query) {
            $car = Car::search($this->search)->first();
            if ($car) {
                $this->dispatch('searchResult', car: $car);
            }

        }

        return view('livewire.search');
    }
}
