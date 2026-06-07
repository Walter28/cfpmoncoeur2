<div>
<div class="dash-container">

    <!-- Page Header -->
    <div class="dash-page-header">
        <div>
            <h4 class="dash-page-title">
                <i class="bi bi-person-badge-fill me-2" style="color:#06BBCC;font-size:1.2rem;"></i>
                Formateurs
            </h4>
            <p class="dash-page-subtitle">Gérez les formateurs et approuvez leurs demandes d'accès</p>
        </div>
        <button data-bs-toggle="modal" data-bs-target="#formateurModal"
                wire:click="$set('editMode', false)"
                style="background:linear-gradient(135deg,#06BBCC,#059aaa);color:#fff;border:none;border-radius:12px;padding:11px 22px;font-family:'Nunito',sans-serif;font-weight:800;font-size:.85rem;cursor:pointer;display:inline-flex;align-items:center;gap:8px;box-shadow:0 4px 14px rgba(6,187,204,.3);transition:all .2s;"
                onmouseover="this.style.transform='translateY(-2px)'"
                onmouseout="this.style.transform=''">
            <i class="bi bi-person-plus-fill"></i> Ajouter un formateur
        </button>
    </div>

    <!-- Stats + Search row -->
    <div style="display:grid;grid-template-columns:1fr 1fr 1fr auto;gap:12px;margin-bottom:20px;align-items:center;">
        <div style="background:#fff;border:1px solid #e8edf5;border-radius:12px;padding:14px 18px;display:flex;align-items:center;gap:10px;">
            <div style="width:38px;height:38px;background:rgba(6,187,204,.1);border-radius:10px;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-people-fill" style="color:#06BBCC;"></i>
            </div>
            <div>
                <div style="font-size:1.4rem;font-weight:900;color:#0f172a;line-height:1;">{{ $totalCount }}</div>
                <div style="font-size:.7rem;color:#94a3b8;font-weight:700;">Total formateurs</div>
            </div>
        </div>
        <div style="background:#fff;border:1px solid #e8edf5;border-radius:12px;padding:14px 18px;display:flex;align-items:center;gap:10px;">
            <div style="width:38px;height:38px;background:rgba(16,185,129,.1);border-radius:10px;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-check-circle-fill" style="color:#10b981;"></i>
            </div>
            <div>
                <div style="font-size:1.4rem;font-weight:900;color:#0f172a;line-height:1;">{{ $totalCount - $pendingCount }}</div>
                <div style="font-size:.7rem;color:#94a3b8;font-weight:700;">Approuvés</div>
            </div>
        </div>
        <div style="background:#fff;border:1px solid {{ $pendingCount > 0 ? '#fde68a' : '#e8edf5' }};border-radius:12px;padding:14px 18px;display:flex;align-items:center;gap:10px;">
            <div style="width:38px;height:38px;background:rgba(245,158,11,.1);border-radius:10px;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-clock-fill" style="color:#f59e0b;"></i>
            </div>
            <div>
                <div style="font-size:1.4rem;font-weight:900;color:#0f172a;line-height:1;">{{ $pendingCount }}</div>
                <div style="font-size:.7rem;color:#94a3b8;font-weight:700;">En attente</div>
            </div>
        </div>
        <div style="position:relative;">
            <i class="bi bi-search" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:.85rem;pointer-events:none;"></i>
            <input wire:model.live.debounce.300ms="searchTerm"
                   type="text" placeholder="Rechercher..."
                   style="padding:10px 14px 10px 36px;border:1.5px solid #e8edf5;border-radius:10px;font-family:'Nunito',sans-serif;font-size:.85rem;width:220px;outline:none;"
                   onfocus="this.style.borderColor='#06BBCC'"
                   onblur="this.style.borderColor='#e8edf5'">
        </div>
    </div>

    <!-- Tabs -->
    <div style="display:flex;gap:6px;margin-bottom:16px;">
        <button wire:click="$set('activeTab','all')"
                style="padding:8px 18px;border-radius:10px;border:none;font-family:'Nunito',sans-serif;font-weight:700;font-size:.82rem;cursor:pointer;transition:all .15s;
                       {{ $activeTab === 'all' ? 'background:linear-gradient(135deg,#06BBCC,#059aaa);color:#fff;box-shadow:0 4px 12px rgba(6,187,204,.3);' : 'background:#f1f5f9;color:#64748b;' }}">
            <i class="bi bi-grid-fill me-1"></i> Tous les formateurs
        </button>
        <button wire:click="$set('activeTab','pending')"
                style="padding:8px 18px;border-radius:10px;border:none;font-family:'Nunito',sans-serif;font-weight:700;font-size:.82rem;cursor:pointer;transition:all .15s;display:inline-flex;align-items:center;gap:6px;
                       {{ $activeTab === 'pending' ? 'background:linear-gradient(135deg,#f59e0b,#d97706);color:#fff;box-shadow:0 4px 12px rgba(245,158,11,.3);' : 'background:#f1f5f9;color:#64748b;' }}">
            <i class="bi bi-clock-fill"></i> En attente d'approbation
            @if($pendingCount > 0)
                <span style="background:{{ $activeTab === 'pending' ? 'rgba(255,255,255,.3)' : '#f59e0b' }};color:#fff;border-radius:20px;padding:1px 7px;font-size:.65rem;font-weight:900;">
                    {{ $pendingCount }}
                </span>
            @endif
        </button>
    </div>

    <!-- Table card -->
    <div class="dash-card" style="margin-bottom:0;">
        <div class="dash-card-header">
            <div>
                <h6 class="dash-card-title">
                    {{ $activeTab === 'pending' ? 'Formateurs en attente d\'approbation' : 'Liste de tous les formateurs' }}
                </h6>
                <p class="dash-card-subtitle">
                    {{ $formateurs->total() }} formateur(s) {{ $activeTab === 'pending' ? 'en attente' : 'enregistré(s)' }}
                </p>
            </div>
        </div>

        @if($activeTab === 'pending' && $pendingCount > 0)
        <div style="background:linear-gradient(135deg,#fffbeb,#fef3c7);border:1px solid #fde68a;border-radius:12px;padding:14px 18px;margin-bottom:16px;display:flex;align-items:center;gap:10px;">
            <i class="bi bi-exclamation-triangle-fill" style="color:#f59e0b;font-size:1.1rem;flex-shrink:0;"></i>
            <div style="font-size:.83rem;color:#78350f;">
                <strong>{{ $pendingCount }} formateur(s)</strong> en attente — Ils ne peuvent pas accéder à leur espace tant que vous n'avez pas approuvé leur compte.
            </div>
        </div>
        @endif

        <div class="dash-table-wrap">
            @if($formateurs->isEmpty())
                <div class="dash-empty-state">
                    <i class="bi bi-person-badge"></i>
                    <p>{{ $activeTab === 'pending' ? 'Aucun formateur en attente d\'approbation' : 'Aucun formateur trouvé' }}</p>
                </div>
            @else
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Formateur</th>
                        <th>Domaine</th>
                        <th>Contact</th>
                        <th>Statut</th>
                        <th>Approbation</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($formateurs as $i => $f)
                    <tr>
                        <td><span class="dash-row-num">{{ $formateurs->firstItem() + $i }}</span></td>
                        <td>
                            <div class="dash-user-cell">
                                @if($f->photo && \Illuminate\Support\Facades\Storage::exists('public/'.$f->photo))
                                    <img src="{{ asset('storage/'.$f->photo) }}"
                                         style="width:36px;height:36px;border-radius:10px;object-fit:cover;flex-shrink:0;">
                                @else
                                    <div class="dash-avatar">{{ strtoupper(substr($f->prenom,0,1).substr($f->nom,0,1)) }}</div>
                                @endif
                                <div>
                                    <div class="dash-user-name">{{ $f->prenom }} {{ $f->nom }}</div>
                                    <div class="dash-user-sub">{{ $f->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="dash-formation-tag">{{ $f->domaine }}</span>
                        </td>
                        <td>
                            <span style="font-size:.82rem;color:#64748b;display:flex;align-items:center;gap:5px;">
                                <i class="bi bi-telephone-fill" style="color:#06BBCC;"></i>
                                {{ $f->contact }}
                            </span>
                        </td>
                        <td>
                            @if($f->status === 'active')
                                <span class="dash-status-badge">Actif</span>
                            @else
                                <span style="display:inline-flex;align-items:center;gap:4px;background:rgba(244,63,94,.1);color:#f43f5e;border-radius:8px;padding:4px 10px;font-size:.72rem;font-weight:700;">
                                    <span style="width:6px;height:6px;border-radius:50%;background:#f43f5e;flex-shrink:0;"></span>
                                    Inactif
                                </span>
                            @endif
                        </td>
                        <td>
                            @if($f->approuve)
                                <span style="display:inline-flex;align-items:center;gap:5px;background:rgba(16,185,129,.1);color:#10b981;border-radius:8px;padding:4px 12px;font-size:.72rem;font-weight:800;">
                                    <i class="bi bi-shield-fill-check" style="font-size:.75rem;"></i> Approuvé
                                </span>
                            @else
                                <span style="display:inline-flex;align-items:center;gap:5px;background:rgba(245,158,11,.1);color:#f59e0b;border-radius:8px;padding:4px 12px;font-size:.72rem;font-weight:800;">
                                    <i class="bi bi-clock-fill" style="font-size:.7rem;"></i> En attente
                                </span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex;align-items:center;gap:5px;flex-wrap:nowrap;">
                                @if(!$f->approuve)
                                <button wire:click="approuverFormateur({{ $f->id }})"
                                        style="height:32px;padding:0 10px;background:rgba(16,185,129,.1);color:#10b981;border:none;border-radius:8px;font-family:'Nunito',sans-serif;font-weight:800;font-size:.72rem;cursor:pointer;display:flex;align-items:center;gap:4px;white-space:nowrap;transition:all .15s;"
                                        onmouseover="this.style.background='#10b981';this.style.color='#fff'"
                                        onmouseout="this.style.background='rgba(16,185,129,.1)';this.style.color='#10b981'"
                                        title="Approuver ce formateur">
                                    <i class="bi bi-check-circle-fill"></i> Approuver
                                </button>
                                <button wire:click="rejeterFormateur({{ $f->id }})"
                                        wire:confirm="Refuser et supprimer ce formateur ?"
                                        style="height:32px;padding:0 10px;background:rgba(244,63,94,.08);color:#f43f5e;border:none;border-radius:8px;font-family:'Nunito',sans-serif;font-weight:800;font-size:.72rem;cursor:pointer;display:flex;align-items:center;gap:4px;white-space:nowrap;transition:all .15s;"
                                        onmouseover="this.style.background='#f43f5e';this.style.color='#fff'"
                                        onmouseout="this.style.background='rgba(244,63,94,.08)';this.style.color='#f43f5e'"
                                        title="Refuser ce formateur">
                                    <i class="bi bi-x-circle-fill"></i> Refuser
                                </button>
                                @else
                                <button wire:click="editFormateur({{ $f->id }})"
                                        style="width:32px;height:32px;background:rgba(79,70,229,.08);color:#4f46e5;border:none;border-radius:8px;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .15s;"
                                        onmouseover="this.style.background='#4f46e5';this.style.color='#fff'"
                                        onmouseout="this.style.background='rgba(79,70,229,.08)';this.style.color='#4f46e5'"
                                        title="Modifier">
                                    <i class="bi bi-pencil-fill" style="font-size:.75rem;"></i>
                                </button>
                                <button wire:click="deleteFormateur({{ $f->id }})"
                                        wire:confirm="Supprimer ce formateur définitivement ?"
                                        style="width:32px;height:32px;background:rgba(244,63,94,.08);color:#f43f5e;border:none;border-radius:8px;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .15s;"
                                        onmouseover="this.style.background='#f43f5e';this.style.color='#fff'"
                                        onmouseout="this.style.background='rgba(244,63,94,.08)';this.style.color='#f43f5e'"
                                        title="Supprimer">
                                    <i class="bi bi-trash3-fill" style="font-size:.75rem;"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($formateurs->hasPages())
            <div style="padding:16px;display:flex;justify-content:center;">
                {{ $formateurs->links('livewire::bootstrap') }}
            </div>
            @endif
            @endif
        </div>
    </div>

    <!-- Modal Ajouter / Modifier -->
    <div class="modal fade" id="formateurModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border-radius:16px;border:none;overflow:hidden;">
                <form wire:submit.prevent="{{ $editMode ? 'updateFormateur' : 'addFormateur' }}" enctype="multipart/form-data">
                    <div class="modal-header" style="background:linear-gradient(135deg,#1a1f3d,#1e2a5e);border:none;padding:20px 24px;">
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:36px;height:36px;background:rgba(6,187,204,.2);border-radius:10px;display:flex;align-items:center;justify-content:center;">
                                <i class="bi bi-person-{{ $editMode ? 'pencil' : 'plus' }}-fill" style="color:#06BBCC;"></i>
                            </div>
                            <h5 class="modal-title" style="font-family:'Nunito',sans-serif;font-weight:900;color:#fff;margin:0;">
                                {{ $editMode ? 'Modifier le formateur' : 'Ajouter un formateur' }}
                            </h5>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" style="padding:24px;">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold" style="font-family:'Nunito',sans-serif;font-size:.82rem;">Nom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror"
                                       wire:model="nom" placeholder="Nom de famille">
                                @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold" style="font-family:'Nunito',sans-serif;font-size:.82rem;">Prénom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('prenom') is-invalid @enderror"
                                       wire:model="prenom" placeholder="Prénom">
                                @error('prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold" style="font-family:'Nunito',sans-serif;font-size:.82rem;">Domaine <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('domaine') is-invalid @enderror"
                                       wire:model="domaine" placeholder="Ex: Informatique, Comptabilité...">
                                @error('domaine')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold" style="font-family:'Nunito',sans-serif;font-size:.82rem;">Contact <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('contact') is-invalid @enderror"
                                       wire:model="contact" placeholder="+243 999 ...">
                                @error('contact')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold" style="font-family:'Nunito',sans-serif;font-size:.82rem;">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       wire:model="email" placeholder="formateur@email.com">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold" style="font-family:'Nunito',sans-serif;font-size:.82rem;">
                                    Mot de passe {{ $editMode ? '(laisser vide = inchangé)' : '' }}
                                    @if(!$editMode)<span class="text-danger">*</span>@endif
                                </label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       wire:model="password"
                                       placeholder="{{ $editMode ? 'Nouveau mot de passe (optionnel)' : 'Minimum 6 caractères' }}">
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-bold" style="font-family:'Nunito',sans-serif;font-size:.82rem;">Adresse <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('adresse') is-invalid @enderror"
                                       wire:model="adresse" placeholder="Adresse complète">
                                @error('adresse')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold" style="font-family:'Nunito',sans-serif;font-size:.82rem;">Date de naissance <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('date_naissance') is-invalid @enderror"
                                       wire:model="date_naissance" max="{{ date('Y-m-d') }}">
                                @error('date_naissance')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold" style="font-family:'Nunito',sans-serif;font-size:.82rem;">Sexe <span class="text-danger">*</span></label>
                                <select class="form-control @error('sexe') is-invalid @enderror" wire:model="sexe">
                                    <option value="">— Choisir —</option>
                                    <option value="homme">Masculin</option>
                                    <option value="femme">Féminin</option>
                                </select>
                                @error('sexe')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold" style="font-family:'Nunito',sans-serif;font-size:.82rem;">Statut</label>
                                <select class="form-control @error('status') is-invalid @enderror" wire:model="status">
                                    <option value="active">Actif</option>
                                    <option value="inactive">Inactif</option>
                                </select>
                                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-bold" style="font-family:'Nunito',sans-serif;font-size:.82rem;">Photo</label>
                                @if($editMode && $photo_old)
                                <div class="mb-2 d-flex align-items-center gap-3">
                                    <img src="{{ asset('storage/'.$photo_old) }}"
                                         style="width:60px;height:60px;object-fit:cover;border-radius:10px;border:2px solid #e8edf5;">
                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                            wire:click="$set('photo_old', null)">Supprimer</button>
                                </div>
                                @endif
                                <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                       wire:model="photo" accept="image/*">
                                <small class="text-muted">JPG, PNG, WEBP — max 15 MB</small>
                                @if($photo && !$photo->getError())
                                <div class="mt-2">
                                    <img src="{{ $photo->temporaryUrl() }}"
                                         style="width:60px;height:60px;object-fit:cover;border-radius:10px;">
                                </div>
                                @endif
                                @error('photo')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top:1px solid #f1f5f9;padding:16px 24px;">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit"
                                style="background:linear-gradient(135deg,#06BBCC,#059aaa);color:#fff;border:none;border-radius:10px;padding:10px 24px;font-family:'Nunito',sans-serif;font-weight:800;font-size:.85rem;cursor:pointer;">
                            <i class="bi bi-{{ $editMode ? 'check-circle' : 'plus-circle' }}-fill me-1"></i>
                            {{ $editMode ? 'Enregistrer' : 'Ajouter' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
</div>
