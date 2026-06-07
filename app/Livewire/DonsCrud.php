<?php

namespace App\Livewire;

use Livewire\Component;

class DonsCrud extends Component
{
    public function render()
    {
        return view('livewire.dons-crud')->layout('layouts.defaultbackend', ['title' => 'Dons']);
    }
}
