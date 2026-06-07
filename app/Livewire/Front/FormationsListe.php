<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Formation;

class FormationsListe extends Component
{
    use WithPagination;

    public string $search   = '';
    public string $categorie = '';
    public string $niveau   = '';

    public function updatedSearch(): void   { $this->resetPage(); }
    public function updatedCategorie(): void { $this->resetPage(); }
    public function updatedNiveau(): void   { $this->resetPage(); }

    public function render()
    {
        $formations = Formation::with('formateur')
            ->where('statut', 'publiee')
            ->when($this->search, fn($q) => $q->where(function ($q2) {
                $q2->where('titre', 'like', "%{$this->search}%")
                   ->orWhere('description', 'like', "%{$this->search}%");
            }))
            ->when($this->categorie, fn($q) => $q->where('categorie', $this->categorie))
            ->when($this->niveau,    fn($q) => $q->where('niveau',   $this->niveau))
            ->latest()
            ->paginate(9);

        return view('livewire.front.formations-liste', [
            'formations' => $formations,
            'categories' => Formation::CATEGORIES,
            'niveaux'    => Formation::NIVEAUX,
        ])->layout('layouts.defaultfrontend', ['title' => 'Nos Formations — CFP Mon Cœur']);
    }
}
