<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Etudiant;
use Illuminate\Support\Facades\Hash;

class EtudiantCrud extends Component
{
    use WithPagination;

    public string $searchTerm = '';
    public bool   $showModal  = false;
    public ?int   $editId     = null;

    public string $nom            = '';
    public string $prenom         = '';
    public string $email          = '';
    public string $contact        = '';
    public string $adresse        = '';
    public string $date_naissance = '';
    public string $sexe           = '';
    public string $password       = '';

    protected function rules(): array
    {
        return [
            'nom'            => 'required|string|max:255',
            'prenom'         => 'required|string|max:255',
            'email'          => 'required|email|max:255|unique:etudiants,email' . ($this->editId ? ",{$this->editId}" : ''),
            'contact'        => 'nullable|string|max:50',
            'adresse'        => 'nullable|string|max:255',
            'date_naissance' => 'nullable|date|before:today',
            'sexe'           => 'nullable|in:homme,femme',
            'password'       => 'nullable|min:6',
        ];
    }

    public function updatingSearchTerm(): void { $this->resetPage(); }

    public function render()
    {
        $query = Etudiant::query();

        if ($this->searchTerm) {
            $query->where(function ($q) {
                $q->where('nom',     'like', "%{$this->searchTerm}%")
                  ->orWhere('prenom', 'like', "%{$this->searchTerm}%")
                  ->orWhere('email',  'like', "%{$this->searchTerm}%")
                  ->orWhere('contact','like', "%{$this->searchTerm}%");
            });
        }

        return view('livewire.etudiant-crud', [
            'etudiants'  => $query->latest()->paginate(12),
            'totalCount' => Etudiant::count(),
        ])->layout('layouts.defaultbackend', ['title' => 'Étudiants']);
    }

    public function openCreate(): void
    {
        $this->reset(['nom','prenom','email','contact','adresse','date_naissance','sexe','password','editId']);
        $this->showModal = true;
        $this->resetErrorBag();
    }

    public function editEtudiant(int $id): void
    {
        $e = Etudiant::findOrFail($id);
        $this->editId         = $id;
        $this->nom            = $e->nom;
        $this->prenom         = $e->prenom;
        $this->email          = $e->email;
        $this->contact        = $e->contact ?? '';
        $this->adresse        = $e->adresse ?? '';
        $this->date_naissance = $e->date_naissance
            ? \Carbon\Carbon::parse($e->date_naissance)->format('Y-m-d') : '';
        $this->sexe           = $e->sexe ?? '';
        $this->password       = '';
        $this->showModal      = true;
        $this->resetErrorBag();
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'nom'            => $this->nom,
            'prenom'         => $this->prenom,
            'email'          => $this->email,
            'contact'        => $this->contact        ?: null,
            'adresse'        => $this->adresse        ?: null,
            'date_naissance' => $this->date_naissance ?: null,
            'sexe'           => $this->sexe           ?: null,
        ];

        if ($this->editId) {
            $e = Etudiant::findOrFail($this->editId);
            $e->update($data);
            if ($this->password && $e->user) {
                $e->user->update(['password' => Hash::make($this->password)]);
            }
            $this->dispatch('showAlert', ['type' => 'success', 'message' => 'Étudiant modifié avec succès.']);
        } else {
            Etudiant::create($data);
            $this->dispatch('showAlert', ['type' => 'success', 'message' => 'Étudiant ajouté avec succès.']);
        }

        $this->showModal = false;
        $this->reset(['nom','prenom','email','contact','adresse','date_naissance','sexe','password','editId']);
        $this->resetErrorBag();
    }

    public function deleteEtudiant(int $id): void
    {
        Etudiant::findOrFail($id)->delete();
        $this->dispatch('showAlert', ['type' => 'success', 'message' => 'Étudiant supprimé avec succès.']);
    }

    public function cancelModal(): void
    {
        $this->showModal = false;
        $this->reset(['nom','prenom','email','contact','adresse','date_naissance','sexe','password','editId']);
        $this->resetErrorBag();
    }
}
