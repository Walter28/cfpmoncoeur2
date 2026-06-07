<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Formation;
use App\Models\Formateur;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    public function render()
    {
        $cours = Formation::with('formateur')
            ->where('statut', 'publiee')
            ->orderBy('created_at', 'desc')
            ->paginate(6);
        
        $formateurs = Formateur::where('approuve', true)->limit(4)->get();
        
        return view('livewire.front.index', [
            'cours' => $cours,
            'formateurs' => $formateurs, // IMPORTANT : Ajoutez cette ligne
        ])->layout('layouts.defaultfrontend', ['title' => 'Accueil']);
    }
}
