<div class="dash-container">
    <div class="dash-page-header">
        <div>
            <h1 class="dash-page-title">Inscriptions</h1>
            <p class="dash-page-subtitle">Suivez les étudiants inscrits à chaque formation.</p>
        </div>
        <button class="btn btn-primary" wire:click="resetFormAndOpen">
            <i class="bi bi-plus-lg me-1"></i> Nouvelle inscription
        </button>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="dash-card">
        <div class="dash-card-header">
            <div>
                <h5 class="dash-card-title">Liste des inscriptions</h5>
                <p class="dash-card-subtitle">{{ $inscriptions->total() }} inscription(s) enregistrée(s)</p>
            </div>
            <input type="text" class="form-control" style="max-width:320px" placeholder="Rechercher..." wire:model.live.debounce.300ms="searchTerm">
        </div>

        <div class="dash-table-wrap">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Étudiant</th>
                        <th>Formation</th>
                        <th>Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($inscriptions as $inscription)
                        <tr>
                            <td><span class="dash-row-num">{{ $inscription->id }}</span></td>
                            <td>
                                <div class="dash-user-cell">
                                    <div class="dash-avatar">
                                        {{ strtoupper(substr($inscription->etudiant?->prenom ?? 'E', 0, 1).substr($inscription->etudiant?->nom ?? '', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="dash-user-name">{{ $inscription->etudiant?->prenom }} {{ $inscription->etudiant?->nom }}</div>
                                        <div class="dash-user-sub">{{ $inscription->etudiant?->email ?? 'Email non renseigné' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="dash-formation-tag">{{ $inscription->formation?->titre ?? 'Formation supprimée' }}</span></td>
                            <td class="dash-date-cell">{{ optional(\Carbon\Carbon::parse($inscription->date_inscription))->format('d/m/Y') }}</td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary" wire:click="editInscription({{ $inscription->id }})">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" onclick="if(!confirm('Supprimer cette inscription ?')) return false;" wire:click="deleteInscription({{ $inscription->id }})">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="dash-empty-state">
                                    <i class="bi bi-inbox"></i>
                                    <p>Aucune inscription trouvée.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $inscriptions->links('livewire::bootstrap') }}
        </div>
    </div>

    <div class="modal fade" id="inscriptionModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $editMode ? 'Modifier l’inscription' : 'Nouvelle inscription' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <form wire:submit.prevent="{{ $editMode ? 'updateInscription' : 'addInscription' }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Étudiant</label>
                            <select class="form-select" wire:model="etudiant_id">
                                <option value="">Choisir un étudiant</option>
                                @foreach($etudiants as $etudiant)
                                    <option value="{{ $etudiant->id }}">{{ $etudiant->prenom }} {{ $etudiant->nom }} — {{ $etudiant->email }}</option>
                                @endforeach
                            </select>
                            @error('etudiant_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Formation</label>
                            <select class="form-select" wire:model="formation_id">
                                <option value="">Choisir une formation</option>
                                @foreach($formations as $formation)
                                    <option value="{{ $formation->id }}">{{ $formation->titre }}</option>
                                @endforeach
                            </select>
                            @error('formation_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Date d’inscription</label>
                            <input type="date" class="form-control" wire:model="date_inscription">
                            @error('date_inscription') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">{{ $editMode ? 'Enregistrer' : 'Créer' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    document.addEventListener('livewire:init', function () {
        Livewire.on('openModal', function () {
            new bootstrap.Modal(document.getElementById('inscriptionModal')).show();
        });
        Livewire.on('closeModal', function () {
            var modal = bootstrap.Modal.getInstance(document.getElementById('inscriptionModal'));
            if (modal) modal.hide();
        });
    });
    </script>
    @endpush
</div>
