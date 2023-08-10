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
        // $this->query = strlen($this->search) >5 ? $this->search : null;
        $this->search = trim($this->search);
        $this->dispatch('searchResult', search: $this->search);
    }

    public function enterSearch()
    {
        $this->search = trim($this->search);
        //$this->query = strlen($this->search) > 5 ? $this->search : null;
        $this->dispatch('searchResult', search: $this->search);
    }

    public function render()
    {
        return view('livewire.search');
    }
}
