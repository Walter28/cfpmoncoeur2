<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Inscription;
use App\Models\Etudiant;
use App\Models\Formation;

class InscriptionCrud extends Component
{
    use WithPagination;

    public string $searchTerm = '';
    public bool $editMode = false;
    public ?int $inscriptionId = null;

    public ?int $etudiant_id = null;
    public ?int $formation_id = null;
    public ?string $date_inscription = null;

    protected $rules = [
        'etudiant_id' => 'required|exists:etudiants,id',
        'formation_id' => 'required|exists:formations,id',
        'date_inscription' => 'required|date',
    ];

    public function updatedSearchTerm(): void
    {
        $this->resetPage();
    }

    public function resetFormAndOpen(): void
    {
        $this->resetForm();
        $this->dispatch('openModal');
    }

    public function render()
    {
        $query = Inscription::with(['etudiant', 'formation']);

        if ($this->searchTerm) {
            $query->where(function ($q) {
                $q->where('etudiant_id', 'like', '%'.$this->searchTerm.'%')
                  ->orWhere('formation_id', 'like', '%'.$this->searchTerm.'%')
                  ->orWhere('date_inscription', 'like', '%'.$this->searchTerm.'%')
                  ->orWhereHas('etudiant', function ($etudiant) {
                      $etudiant->where('nom', 'like', '%'.$this->searchTerm.'%')
                          ->orWhere('prenom', 'like', '%'.$this->searchTerm.'%')
                          ->orWhere('email', 'like', '%'.$this->searchTerm.'%');
                  })
                  ->orWhereHas('formation', function ($formation) {
                      $formation->where('titre', 'like', '%'.$this->searchTerm.'%');
                  });
            });
        }

        return view('livewire.inscription-crud', [
            'inscriptions' => $query->orderByDesc('id')->paginate(10),
            'etudiants' => Etudiant::orderBy('nom')->orderBy('prenom')->get(),
            'formations' => Formation::orderBy('titre')->get(),
        ])->layout('layouts.defaultbackend', ['title' => 'Inscriptions']);
    }

    public function addInscription(): void
    {
        $this->validate();

        Inscription::create([
            'etudiant_id' => $this->etudiant_id,
            'formation_id' => $this->formation_id,
            'date_inscription' => $this->date_inscription,
        ]);

        $this->resetForm();
        session()->flash('message', 'Inscription ajoutée avec succès.');
        $this->dispatch('closeModal');
    }

    public function editInscription(int $id): void
    {
        $inscription = Inscription::findOrFail($id);

        $this->inscriptionId = $id;
        $this->etudiant_id = $inscription->etudiant_id;
        $this->formation_id = $inscription->formation_id;
        $this->date_inscription = $inscription->date_inscription;

        $this->editMode = true;
        $this->dispatch('openModal');
    }

    public function updateInscription(): void
    {
        $this->validate();

        Inscription::findOrFail($this->inscriptionId)->update([
            'etudiant_id' => $this->etudiant_id,
            'formation_id' => $this->formation_id,
            'date_inscription' => $this->date_inscription,
        ]);

        $this->resetForm();
        session()->flash('message', 'Inscription modifiée avec succès.');
        $this->dispatch('closeModal');
    }

    public function deleteInscription(int $id): void
    {
        Inscription::findOrFail($id)->delete();
        session()->flash('message', 'Inscription supprimée avec succès.');
    }

    public function resetForm(): void
    {
        $this->reset([
            'inscriptionId',
            'formation_id',
            'etudiant_id',
            'date_inscription',
            'editMode',
        ]);
        $this->resetErrorBag();
    }
}
