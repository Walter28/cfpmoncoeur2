<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Formateur;
use Illuminate\Support\Facades\Storage;

class FormateurCrud extends Component
{
    use WithPagination, WithFileUploads;

    public string $searchTerm     = '';
    public string $activeTab      = 'all'; // 'all' | 'pending'
    public bool   $editMode       = false;
    public ?int   $formateurId    = null;

    public string $nom            = '';
    public string $prenom         = '';
    public string $domaine        = '';
    public string $contact        = '';
    public string $email          = '';
    public string $adresse        = '';
    public string $date_naissance = '';
    public string $sexe           = '';
    public        $photo;
    public        $photo_old;
    public string $status         = 'active';
    public string $password       = '';

    protected $queryString = ['searchTerm'];

    protected function rules(): array
    {
        return [
            'nom'            => 'required|string|max:255',
            'prenom'         => 'required|string|max:255',
            'domaine'        => 'required|string|max:255',
            'contact'        => 'required|string|max:50',
            'email'          => 'required|email|max:255|unique:formateurs,email' . ($this->editMode ? ",{$this->formateurId}" : ''),
            'adresse'        => 'required|string|max:255',
            'date_naissance' => 'required|date|before:today',
            'sexe'           => 'required|in:homme,femme',
            'photo'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:15360',
            'status'         => 'nullable|in:active,inactive',
            'password'       => $this->editMode ? 'nullable|string|min:6' : 'required|string|min:6',
        ];
    }

    public function updatingSearchTerm(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Formateur::query();

        if ($this->searchTerm) {
            $query->where(function ($q) {
                $q->where('nom',      'like', "%{$this->searchTerm}%")
                  ->orWhere('prenom',  'like', "%{$this->searchTerm}%")
                  ->orWhere('domaine', 'like', "%{$this->searchTerm}%")
                  ->orWhere('email',   'like', "%{$this->searchTerm}%")
                  ->orWhere('contact', 'like', "%{$this->searchTerm}%");
            });
        }

        if ($this->activeTab === 'pending') {
            $query->where('approuve', false);
        }

        return view('livewire.formateur-crud', [
            'formateurs'   => $query->latest()->paginate(12),
            'pendingCount' => Formateur::where('approuve', false)->count(),
            'totalCount'   => Formateur::count(),
        ])->layout('layouts.defaultbackend', ['title' => 'Formateurs']);
    }

    /* ─── Approbation ─── */

    public function approuverFormateur(int $id): void
    {
        Formateur::findOrFail($id)->update(['approuve' => true]);
        $this->dispatch('showAlert', ['type' => 'success', 'message' => 'Formateur approuvé avec succès.']);
    }

    public function rejeterFormateur(int $id): void
    {
        $f = Formateur::findOrFail($id);
        if ($f->photo && Storage::disk('public')->exists($f->photo)) {
            Storage::disk('public')->delete($f->photo);
        }
        $f->delete();
        $this->dispatch('showAlert', ['type' => 'warning', 'message' => 'Formateur refusé et supprimé.']);
    }

    /* ─── CRUD ─── */

    public function addFormateur(): void
    {
        $this->validate();

        $photoPath = $this->photo ? $this->photo->store('photoformateurs', 'public') : null;

        Formateur::create([
            'user_id'        => auth()->id(),
            'nom'            => $this->nom,
            'prenom'         => $this->prenom,
            'domaine'        => $this->domaine,
            'contact'        => $this->contact,
            'email'          => $this->email,
            'adresse'        => $this->adresse,
            'date_naissance' => $this->date_naissance,
            'sexe'           => $this->sexe,
            'photo'          => $photoPath,
            'status'         => $this->status,
            'password'       => bcrypt($this->password),
            'approuve'       => true,
        ]);

        $this->resetForm();
        $this->dispatch('closeModal');
        $this->dispatch('showAlert', ['type' => 'success', 'message' => 'Formateur ajouté et approuvé avec succès.']);
    }

    public function editFormateur(int $id): void
    {
        $f = Formateur::findOrFail($id);

        $this->formateurId    = $f->id;
        $this->nom            = $f->nom;
        $this->prenom         = $f->prenom;
        $this->domaine        = $f->domaine;
        $this->contact        = $f->contact;
        $this->email          = $f->email;
        $this->adresse        = $f->adresse;
        $this->date_naissance = $f->date_naissance;
        $this->sexe           = $f->sexe;
        $this->status         = $f->status;
        $this->photo_old      = $f->photo;
        $this->editMode       = true;

        $this->dispatch('openModal');
    }

    public function updateFormateur(): void
    {
        $this->validate();

        $f = Formateur::findOrFail($this->formateurId);

        $photoPath = $f->photo;
        if ($this->photo) {
            if ($f->photo && Storage::disk('public')->exists($f->photo)) {
                Storage::disk('public')->delete($f->photo);
            }
            $photoPath = $this->photo->store('photoformateurs', 'public');
        }

        $data = [
            'nom' => $this->nom, 'prenom' => $this->prenom,
            'domaine' => $this->domaine, 'contact' => $this->contact,
            'email' => $this->email, 'adresse' => $this->adresse,
            'date_naissance' => $this->date_naissance, 'sexe' => $this->sexe,
            'photo' => $photoPath, 'status' => $this->status,
        ];

        if (!empty($this->password)) {
            $data['password'] = bcrypt($this->password);
        }

        $f->update($data);

        $this->resetForm();
        $this->dispatch('closeModal');
        $this->dispatch('showAlert', ['type' => 'success', 'message' => 'Formateur modifié avec succès.']);
    }

    public function deleteFormateur(?int $id = null): void
    {
        $fId = $id ?? $this->formateurId;
        $f   = Formateur::find($fId);

        if ($f) {
            if ($f->photo && Storage::disk('public')->exists($f->photo)) {
                Storage::disk('public')->delete($f->photo);
            }
            $f->delete();
            $this->dispatch('showAlert', ['type' => 'success', 'message' => 'Formateur supprimé avec succès.']);
        }
        $this->formateurId = null;
    }

    public function cancel(): void
    {
        $this->resetForm();
        $this->dispatch('closeModal');
    }

    private function resetForm(): void
    {
        $this->reset([
            'formateurId', 'nom', 'prenom', 'domaine', 'contact', 'email',
            'adresse', 'date_naissance', 'sexe', 'photo', 'photo_old',
            'status', 'password', 'editMode',
        ]);
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
