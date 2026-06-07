<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Formation;
use App\Models\Etudiant;
use App\Models\Inscription;

class FormationDetail extends Component
{
    public Formation $formation;
    public bool $dejaInscrit = false;
    public bool $inscriptionSuccess = false;
    public string $inscriptionError = '';

    public function mount(int $id): void
    {
        $this->formation = Formation::with('formateur')->findOrFail($id);

        if (auth()->check()) {
            $etudiant = Etudiant::where('user_id', auth()->id())->first();
            if ($etudiant) {
                $this->dejaInscrit = Inscription::where('etudiant_id', $etudiant->id)
                    ->where('formation_id', $this->formation->id)
                    ->exists();
            }
        }
    }

    public function sInscrire(): void
    {
        if (! auth()->check()) {
            $this->inscriptionError = 'Vous devez être connecté pour vous inscrire.';
            return;
        }

        $etudiant = Etudiant::where('user_id', auth()->id())->first();

        if (! $etudiant) {
            $this->inscriptionError = 'Votre profil étudiant est introuvable. Contactez l\'administration.';
            return;
        }

        if ($this->dejaInscrit) {
            $this->inscriptionError = 'Vous êtes déjà inscrit à cette formation.';
            return;
        }

        Inscription::create([
            'etudiant_id'      => $etudiant->id,
            'formation_id'     => $this->formation->id,
            'date_inscription' => now()->toDateString(),
        ]);

        $this->dejaInscrit         = true;
        $this->inscriptionSuccess  = true;
        $this->inscriptionError    = '';
    }

    public function render()
    {
        return view('livewire.front.formation-detail')
            ->layout('layouts.defaultfrontend', ['title' => $this->formation->titre]);
    }
}
