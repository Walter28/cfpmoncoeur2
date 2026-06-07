<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Formateur;

class About extends Component
{
    public function render()
    {
        // Récupérer TOUS les formateurs
        $formateurs = Formateur::orderBy('nom')->get();

        // Statistiques
        $stats = [
            'etudiants' => 500,
            'formateurs' => $formateurs->count(),
            'formations' => 15,
            'taux_reussite' => 95,
        ];

        return view('livewire.front.about', [
            'formateurs' => $formateurs,
            'stats' => $stats
        ])->layout('layouts.defaultfrontend', [
            'title' => 'À propos - CFP Mon Coeur'
        ]);
    }
}