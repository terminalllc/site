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
        $this->query = strlen($this->search) >2 ? $this->search : null;

    }

    public function render()
    {
        if ($this->query) {
            $car = Car::search($this->search)->first();

            $this->dispatch('searchResult', car: $car ?? new Car);

        }

        return view('livewire.search');
    }
}
