<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Formation;
use App\Models\Formateur;
use Illuminate\Support\Facades\Storage;

class FormationCrud extends Component
{
    use WithPagination, WithFileUploads;

    public string $searchTerm  = '';
    public string $filterStatut = 'all';
    public bool   $editMode    = false;
    public ?int   $formationId = null;

    // Champs du formulaire
    public ?string $titre       = null;
    public ?string $categorie   = null;
    public ?string $niveau      = null;
    public ?string $description = null;
    public ?string $objectif    = null;
    public ?string $session     = null;
    public ?string $prerequis   = null;
    public ?string $duree       = null;
    public ?string $date_debut  = null;
    public ?string $date_fin    = null;
    public ?string $lieu        = null;
    public        $prix         = null;
    public        $photo;
    public ?string $photo_old   = null;
    public ?string $video       = null;
    public ?int    $formateur_id = null;
    public string  $statut      = 'brouillon';

    protected function rules(): array
    {
        return [
            'titre'        => 'required|string|max:255',
            'description'  => 'required|string',
            'categorie'    => 'nullable|string|max:100',
            'niveau'       => 'nullable|string|max:100',
            'objectif'     => 'nullable|string',
            'session'      => 'nullable|string|max:255',
            'prerequis'    => 'nullable|string',
            'duree'        => 'nullable|string|max:255',
            'date_debut'   => 'nullable|date',
            'date_fin'     => 'nullable|date|after_or_equal:date_debut',
            'lieu'         => 'nullable|string|max:255',
            'prix'         => 'required|numeric|min:0',
            'photo'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:15360',
            'video'        => 'nullable|string|max:500',
            'formateur_id' => 'required|exists:formateurs,id',
            'statut'       => 'required|in:brouillon,publiee,suspendue,archivee',
        ];
    }

    protected $messages = [
        'titre.required'       => 'Le titre est obligatoire.',
        'description.required' => 'La description est obligatoire.',
        'prix.required'        => 'Le prix est obligatoire.',
        'prix.numeric'         => 'Le prix doit être un nombre.',
        'formateur_id.required'=> 'Veuillez sélectionner un formateur.',
        'date_fin.after_or_equal' => 'La date de fin doit être après la date de début.',
    ];

    public function updatedSearchTerm(): void
    {
        $this->resetPage();
    }

    public function updatedFilterStatut(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $formateurs = Formateur::orderBy('nom')->get();

        $query = Formation::with(['formateur', 'inscriptions'])
            ->when($this->searchTerm, function ($q) {
                $q->where(function ($inner) {
                    $inner->where('titre', 'like', "%{$this->searchTerm}%")
                          ->orWhere('description', 'like', "%{$this->searchTerm}%")
                          ->orWhere('categorie', 'like', "%{$this->searchTerm}%")
                          ->orWhereHas('formateur', function ($f) {
                              $f->where('nom', 'like', "%{$this->searchTerm}%")
                                ->orWhere('prenom', 'like', "%{$this->searchTerm}%");
                          });
                });
            })
            ->when($this->filterStatut !== 'all', function ($q) {
                $q->where('statut', $this->filterStatut);
            })
            ->latest();

        // Counts per statut for tabs
        $counts = [
            'all'       => Formation::count(),
            'publiee'   => Formation::where('statut', 'publiee')->count(),
            'brouillon' => Formation::where('statut', 'brouillon')->count(),
            'suspendue' => Formation::where('statut', 'suspendue')->count(),
            'archivee'  => Formation::where('statut', 'archivee')->count(),
        ];

        $formations = $query->paginate(9);

        return view('livewire.formation-crud', compact('formations', 'formateurs', 'counts'))
            ->layout('layouts.defaultbackend', ['title' => 'Formations']);
    }

    public function resetFormAndOpen(): void
    {
        $this->resetForm();
        $this->dispatch('openModal');
    }

    public function changeStatut(int $id, string $statut): void
    {
        $allowed = array_keys(Formation::STATUTS);
        if (!in_array($statut, $allowed)) return;

        Formation::findOrFail($id)->update(['statut' => $statut]);
        $labels = Formation::STATUTS;
        session()->flash('message', 'Statut mis à jour : ' . ($labels[$statut]['label'] ?? $statut));
    }

    public function addFormation(): void
    {
        $this->validate();

        $photoPath = null;
        if ($this->photo) {
            $photoPath = $this->photo->store('formations/' . date('Y/m'), 'public');
        }

        Formation::create([
            'titre'        => $this->titre,
            'categorie'    => $this->categorie,
            'niveau'       => $this->niveau,
            'description'  => $this->description,
            'objectif'     => $this->objectif,
            'session'      => $this->session,
            'prerequis'    => $this->prerequis,
            'duree'        => $this->duree,
            'date_debut'   => $this->date_debut,
            'date_fin'     => $this->date_fin,
            'lieu'         => $this->lieu,
            'prix'         => $this->prix,
            'photo'        => $photoPath,
            'video'        => $this->video,
            'formateur_id' => $this->formateur_id,
            'statut'       => $this->statut,
        ]);

        $this->resetForm();
        session()->flash('message', 'Formation créée avec succès.');
        $this->dispatch('closeModal');
    }

    public function editFormation(int $id): void
    {
        $f = Formation::findOrFail($id);

        $this->formationId  = $f->id;
        $this->titre        = $f->titre;
        $this->categorie    = $f->categorie;
        $this->niveau       = $f->niveau;
        $this->description  = $f->description;
        $this->objectif     = $f->objectif;
        $this->session      = $f->session;
        $this->prerequis    = $f->prerequis;
        $this->duree        = $f->duree;
        $this->date_debut   = $f->date_debut?->format('Y-m-d');
        $this->date_fin     = $f->date_fin?->format('Y-m-d');
        $this->lieu         = $f->lieu;
        $this->prix         = $f->prix;
        $this->photo_old    = $f->photo;
        $this->video        = $f->video;
        $this->formateur_id = $f->formateur_id;
        $this->statut       = $f->statut ?? 'brouillon';
        $this->editMode     = true;

        $this->dispatch('openModal');
    }

    public function updateFormation(): void
    {
        $this->validate();

        $formation = Formation::findOrFail($this->formationId);

        $photoPath = $formation->photo;
        if ($this->photo) {
            if ($formation->photo && Storage::disk('public')->exists($formation->photo)) {
                Storage::disk('public')->delete($formation->photo);
            }
            $photoPath = $this->photo->store('formations/' . date('Y/m'), 'public');
        }

        $formation->update([
            'titre'        => $this->titre,
            'categorie'    => $this->categorie,
            'niveau'       => $this->niveau,
            'description'  => $this->description,
            'objectif'     => $this->objectif,
            'session'      => $this->session,
            'prerequis'    => $this->prerequis,
            'duree'        => $this->duree,
            'date_debut'   => $this->date_debut,
            'date_fin'     => $this->date_fin,
            'lieu'         => $this->lieu,
            'prix'         => $this->prix,
            'photo'        => $photoPath,
            'video'        => $this->video,
            'formateur_id' => $this->formateur_id,
            'statut'       => $this->statut,
        ]);

        $this->resetForm();
        session()->flash('message', 'Formation modifiée avec succès.');
        $this->dispatch('closeModal');
    }

    public function deleteFormation(int $id): void
    {
        $formation = Formation::find($id);
        if ($formation) {
            if ($formation->photo && Storage::disk('public')->exists($formation->photo)) {
                Storage::disk('public')->delete($formation->photo);
            }
            $formation->delete();
            session()->flash('message', 'Formation supprimée.');
        }
    }

    public function resetForm(): void
    {
        $this->reset([
            'formationId', 'titre', 'categorie', 'niveau', 'description',
            'objectif', 'session', 'prerequis', 'duree', 'date_debut',
            'date_fin', 'lieu', 'prix', 'photo', 'photo_old', 'video',
            'formateur_id', 'editMode',
        ]);
        $this->statut = 'brouillon';
        $this->resetErrorBag();
    }
}
