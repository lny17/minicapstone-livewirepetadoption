<?php

namespace App\Livewire;

use App\Models\AdoptationRequest;
use App\Models\Adoptations;
use App\Models\Adopter;
use App\Models\Pet;
use App\Models\Staff;
use Livewire\Component;

class Dashboard extends Component
{
    public $petsCount;
    public $adoptersCount;
    public $staffsCount;
    public $adoptationsCount;
    public $adoptationRequestCount;

    public function mount(){
        $this->petsCount = Pet::count();
        $this->adoptersCount = Adopter::count();
        $this->staffsCount = Staff::count();
        $this->adoptationsCount = Adoptations::count();
        $this->adoptationRequestCount = AdoptationRequest::count();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
