<div>
<div class="dash-container">

    <!-- Page Header -->
    <div class="dash-page-header">
        <div>
            <h4 class="dash-page-title">
                <i class="bi bi-mortarboard-fill me-2" style="color:#f59e0b;font-size:1.2rem;"></i>
                Étudiants
            </h4>
            <p class="dash-page-subtitle">Gérez les profils et les dossiers étudiants</p>
        </div>
        <button wire:click="openCreate"
                style="background:linear-gradient(135deg,#f59e0b,#d97706);color:#fff;border:none;border-radius:12px;padding:11px 22px;font-family:'Nunito',sans-serif;font-weight:800;font-size:.85rem;cursor:pointer;display:inline-flex;align-items:center;gap:8px;box-shadow:0 4px 14px rgba(245,158,11,.3);transition:all .2s;"
                onmouseover="this.style.transform='translateY(-2px)'"
                onmouseout="this.style.transform=''">
            <i class="bi bi-person-plus-fill"></i> Ajouter un étudiant
        </button>
    </div>

    <!-- Stats + Search row -->
    <div style="display:grid;grid-template-columns:1fr 1fr auto;gap:12px;margin-bottom:20px;align-items:center;">
        <div style="background:#fff;border:1px solid #e8edf5;border-radius:12px;padding:14px 18px;display:flex;align-items:center;gap:10px;">
            <div style="width:38px;height:38px;background:rgba(245,158,11,.1);border-radius:10px;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-mortarboard-fill" style="color:#f59e0b;"></i>
            </div>
            <div>
                <div style="font-size:1.4rem;font-weight:900;color:#0f172a;line-height:1;">{{ $totalCount }}</div>
                <div style="font-size:.7rem;color:#94a3b8;font-weight:700;">Total étudiants</div>
            </div>
        </div>
        <div style="background:#fff;border:1px solid #e8edf5;border-radius:12px;padding:14px 18px;display:flex;align-items:center;gap:10px;">
            <div style="width:38px;height:38px;background:rgba(6,187,204,.1);border-radius:10px;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-person-check-fill" style="color:#06BBCC;"></i>
            </div>
            <div>
                <div style="font-size:1.4rem;font-weight:900;color:#0f172a;line-height:1;">{{ $etudiants->total() }}</div>
                <div style="font-size:.7rem;color:#94a3b8;font-weight:700;">Résultats affichés</div>
            </div>
        </div>
        <div style="position:relative;">
            <i class="bi bi-search" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:.85rem;pointer-events:none;"></i>
            <input wire:model.live.debounce.300ms="searchTerm"
                   type="text" placeholder="Rechercher un étudiant..."
                   style="padding:10px 14px 10px 36px;border:1.5px solid #e8edf5;border-radius:10px;font-family:'Nunito',sans-serif;font-size:.85rem;width:250px;outline:none;"
                   onfocus="this.style.borderColor='#f59e0b'"
                   onblur="this.style.borderColor='#e8edf5'">
        </div>
    </div>

    <!-- Modal inline (show/hide) -->
    @if($showModal)
    <div style="position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:9000;display:flex;align-items:center;justify-content:center;padding:20px;">
        <div style="background:#fff;border-radius:20px;width:100%;max-width:640px;max-height:90vh;overflow-y:auto;box-shadow:0 24px 64px rgba(0,0,0,.18);">
            <!-- Modal Header -->
            <div style="background:linear-gradient(135deg,#1a1f3d,#1e2a5e);border-radius:20px 20px 0 0;padding:20px 24px;display:flex;align-items:center;justify-content:space-between;">
                <div style="display:flex;align-items:center;gap:10px;">
                    <div style="width:36px;height:36px;background:rgba(245,158,11,.2);border-radius:10px;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-mortarboard-fill" style="color:#f59e0b;"></i>
                    </div>
                    <h5 style="font-family:'Nunito',sans-serif;font-weight:900;color:#fff;margin:0;font-size:1rem;">
                        {{ $editId ? 'Modifier l\'étudiant' : 'Ajouter un étudiant' }}
                    </h5>
                </div>
                <button wire:click="cancelModal"
                        style="background:rgba(255,255,255,.1);border:none;border-radius:8px;width:32px;height:32px;display:flex;align-items:center;justify-content:center;cursor:pointer;color:#fff;">
                    <i class="bi bi-x"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <form wire:submit.prevent="save" style="padding:24px;">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label style="font-family:'Nunito',sans-serif;font-weight:700;font-size:.82rem;color:#374151;display:block;margin-bottom:6px;">
                            Nom <span style="color:#f43f5e;">*</span>
                        </label>
                        <input wire:model="nom" type="text" placeholder="Nom de famille"
                               class="@error('nom') is-invalid @enderror"
                               style="width:100%;padding:10px 14px;border:1.5px solid #e8edf5;border-radius:10px;font-family:'Nunito',sans-serif;font-size:.875rem;outline:none;transition:border-color .15s;"
                               onfocus="this.style.borderColor='#f59e0b'" onblur="this.style.borderColor='#e8edf5'">
                        @error('nom')<p style="color:#f43f5e;font-size:.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                    </div>
                    <div class="col-md-6">
                        <label style="font-family:'Nunito',sans-serif;font-weight:700;font-size:.82rem;color:#374151;display:block;margin-bottom:6px;">
                            Prénom <span style="color:#f43f5e;">*</span>
                        </label>
                        <input wire:model="prenom" type="text" placeholder="Prénom"
                               style="width:100%;padding:10px 14px;border:1.5px solid #e8edf5;border-radius:10px;font-family:'Nunito',sans-serif;font-size:.875rem;outline:none;transition:border-color .15s;"
                               onfocus="this.style.borderColor='#f59e0b'" onblur="this.style.borderColor='#e8edf5'">
                        @error('prenom')<p style="color:#f43f5e;font-size:.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                    </div>
                    <div class="col-md-6">
                        <label style="font-family:'Nunito',sans-serif;font-weight:700;font-size:.82rem;color:#374151;display:block;margin-bottom:6px;">
                            Email <span style="color:#f43f5e;">*</span>
                        </label>
                        <input wire:model="email" type="email" placeholder="etudiant@email.com"
                               style="width:100%;padding:10px 14px;border:1.5px solid #e8edf5;border-radius:10px;font-family:'Nunito',sans-serif;font-size:.875rem;outline:none;transition:border-color .15s;"
                               onfocus="this.style.borderColor='#f59e0b'" onblur="this.style.borderColor='#e8edf5'">
                        @error('email')<p style="color:#f43f5e;font-size:.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                    </div>
                    <div class="col-md-6">
                        <label style="font-family:'Nunito',sans-serif;font-weight:700;font-size:.82rem;color:#374151;display:block;margin-bottom:6px;">
                            Téléphone
                        </label>
                        <input wire:model="contact" type="text" placeholder="+243 999 ..."
                               style="width:100%;padding:10px 14px;border:1.5px solid #e8edf5;border-radius:10px;font-family:'Nunito',sans-serif;font-size:.875rem;outline:none;transition:border-color .15s;"
                               onfocus="this.style.borderColor='#f59e0b'" onblur="this.style.borderColor='#e8edf5'">
                        @error('contact')<p style="color:#f43f5e;font-size:.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                    </div>
                    <div class="col-md-6">
                        <label style="font-family:'Nunito',sans-serif;font-weight:700;font-size:.82rem;color:#374151;display:block;margin-bottom:6px;">
                            Date de naissance
                        </label>
                        <input wire:model="date_naissance" type="date" max="{{ date('Y-m-d') }}"
                               style="width:100%;padding:10px 14px;border:1.5px solid #e8edf5;border-radius:10px;font-family:'Nunito',sans-serif;font-size:.875rem;outline:none;transition:border-color .15s;"
                               onfocus="this.style.borderColor='#f59e0b'" onblur="this.style.borderColor='#e8edf5'">
                        @error('date_naissance')<p style="color:#f43f5e;font-size:.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                    </div>
                    <div class="col-md-6">
                        <label style="font-family:'Nunito',sans-serif;font-weight:700;font-size:.82rem;color:#374151;display:block;margin-bottom:6px;">
                            Sexe
                        </label>
                        <select wire:model="sexe"
                                style="width:100%;padding:10px 14px;border:1.5px solid #e8edf5;border-radius:10px;font-family:'Nunito',sans-serif;font-size:.875rem;outline:none;background:#fff;transition:border-color .15s;"
                                onfocus="this.style.borderColor='#f59e0b'" onblur="this.style.borderColor='#e8edf5'">
                            <option value="">— Choisir —</option>
                            <option value="homme">Masculin</option>
                            <option value="femme">Féminin</option>
                        </select>
                        @error('sexe')<p style="color:#f43f5e;font-size:.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                    </div>
                    <div class="col-12">
                        <label style="font-family:'Nunito',sans-serif;font-weight:700;font-size:.82rem;color:#374151;display:block;margin-bottom:6px;">
                            Adresse
                        </label>
                        <input wire:model="adresse" type="text" placeholder="Quartier, ville..."
                               style="width:100%;padding:10px 14px;border:1.5px solid #e8edf5;border-radius:10px;font-family:'Nunito',sans-serif;font-size:.875rem;outline:none;transition:border-color .15s;"
                               onfocus="this.style.borderColor='#f59e0b'" onblur="this.style.borderColor='#e8edf5'">
                        @error('adresse')<p style="color:#f43f5e;font-size:.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                    </div>
                    @if($editId)
                    <div class="col-12">
                        <label style="font-family:'Nunito',sans-serif;font-weight:700;font-size:.82rem;color:#374151;display:block;margin-bottom:6px;">
                            Nouveau mot de passe <span style="font-weight:400;color:#94a3b8;">(laisser vide = inchangé)</span>
                        </label>
                        <input wire:model="password" type="password" placeholder="Min. 6 caractères"
                               style="width:100%;padding:10px 14px;border:1.5px solid #e8edf5;border-radius:10px;font-family:'Nunito',sans-serif;font-size:.875rem;outline:none;transition:border-color .15s;"
                               onfocus="this.style.borderColor='#f59e0b'" onblur="this.style.borderColor='#e8edf5'">
                        @error('password')<p style="color:#f43f5e;font-size:.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                    </div>
                    @endif
                </div>

                <div style="display:flex;gap:10px;margin-top:24px;padding-top:18px;border-top:1px solid #f1f5f9;">
                    <button type="submit"
                            style="background:linear-gradient(135deg,#f59e0b,#d97706);color:#fff;border:none;border-radius:10px;padding:11px 26px;font-family:'Nunito',sans-serif;font-weight:800;font-size:.85rem;cursor:pointer;display:flex;align-items:center;gap:8px;">
                        <i class="bi bi-{{ $editId ? 'check-circle-fill' : 'person-plus-fill' }}"></i>
                        {{ $editId ? 'Enregistrer' : 'Ajouter l\'étudiant' }}
                    </button>
                    <button type="button" wire:click="cancelModal"
                            style="background:#f1f5f9;color:#64748b;border:none;border-radius:10px;padding:11px 20px;font-family:'Nunito',sans-serif;font-weight:700;font-size:.85rem;cursor:pointer;">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- Table card -->
    <div class="dash-card" style="margin-bottom:0;">
        <div class="dash-card-header">
            <div>
                <h6 class="dash-card-title">Liste des étudiants</h6>
                <p class="dash-card-subtitle">{{ $etudiants->total() }} étudiant(s) trouvé(s)</p>
            </div>
        </div>

        <div class="dash-table-wrap">
            @if($etudiants->isEmpty())
                <div class="dash-empty-state">
                    <i class="bi bi-mortarboard"></i>
                    <p>Aucun étudiant trouvé. Les étudiants apparaissent ici dès qu'ils s'inscrivent sur le site.</p>
                </div>
            @else
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Étudiant</th>
                        <th>Téléphone</th>
                        <th>Genre</th>
                        <th>Date de naissance</th>
                        <th>Inscriptions</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($etudiants as $i => $e)
                    <tr>
                        <td><span class="dash-row-num">{{ $etudiants->firstItem() + $i }}</span></td>
                        <td>
                            <div class="dash-user-cell">
                                <div class="dash-avatar"
                                     style="background:linear-gradient(135deg,#f59e0b,#d97706);">
                                    {{ strtoupper(substr($e->prenom,0,1).substr($e->nom,0,1)) }}
                                </div>
                                <div>
                                    <div class="dash-user-name">{{ $e->prenom }} {{ $e->nom }}</div>
                                    <div class="dash-user-sub">{{ $e->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($e->contact)
                            <span style="font-size:.82rem;color:#64748b;display:flex;align-items:center;gap:5px;">
                                <i class="bi bi-telephone-fill" style="color:#f59e0b;"></i>
                                {{ $e->contact }}
                            </span>
                            @else
                            <span style="color:#cbd5e1;font-size:.8rem;">—</span>
                            @endif
                        </td>
                        <td>
                            @if($e->sexe === 'homme')
                                <span style="background:rgba(79,70,229,.08);color:#4f46e5;border-radius:8px;padding:4px 10px;font-size:.72rem;font-weight:700;">♂ Masculin</span>
                            @elseif($e->sexe === 'femme')
                                <span style="background:rgba(244,63,94,.08);color:#f43f5e;border-radius:8px;padding:4px 10px;font-size:.72rem;font-weight:700;">♀ Féminin</span>
                            @else
                                <span style="color:#cbd5e1;font-size:.8rem;">—</span>
                            @endif
                        </td>
                        <td class="dash-date-cell">
                            @if($e->date_naissance)
                                <i class="bi bi-calendar3 me-1"></i>
                                {{ \Carbon\Carbon::parse($e->date_naissance)->format('d/m/Y') }}
                            @else
                                <span style="color:#cbd5e1;">—</span>
                            @endif
                        </td>
                        <td>
                            @php $insCount = $e->inscriptions()->count(); @endphp
                            @if($insCount > 0)
                                <span style="background:rgba(16,185,129,.1);color:#059669;border-radius:8px;padding:4px 10px;font-size:.72rem;font-weight:800;">
                                    <i class="bi bi-book-fill me-1"></i>{{ $insCount }} cours
                                </span>
                            @else
                                <span style="background:#f8fafc;color:#94a3b8;border-radius:8px;padding:4px 10px;font-size:.72rem;font-weight:700;">
                                    Aucun cours
                                </span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex;align-items:center;gap:6px;">
                                <button wire:click="editEtudiant({{ $e->id }})"
                                        style="width:32px;height:32px;background:rgba(245,158,11,.08);color:#f59e0b;border:none;border-radius:8px;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .15s;"
                                        onmouseover="this.style.background='#f59e0b';this.style.color='#fff'"
                                        onmouseout="this.style.background='rgba(245,158,11,.08)';this.style.color='#f59e0b'"
                                        title="Modifier">
                                    <i class="bi bi-pencil-fill" style="font-size:.75rem;"></i>
                                </button>
                                <button wire:click="deleteEtudiant({{ $e->id }})"
                                        wire:confirm="Supprimer cet étudiant définitivement ?"
                                        style="width:32px;height:32px;background:rgba(244,63,94,.08);color:#f43f5e;border:none;border-radius:8px;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .15s;"
                                        onmouseover="this.style.background='#f43f5e';this.style.color='#fff'"
                                        onmouseout="this.style.background='rgba(244,63,94,.08)';this.style.color='#f43f5e'"
                                        title="Supprimer">
                                    <i class="bi bi-trash3-fill" style="font-size:.75rem;"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($etudiants->hasPages())
            <div style="padding:16px;display:flex;justify-content:center;">
                {{ $etudiants->links('livewire::bootstrap') }}
            </div>
            @endif
            @endif
        </div>
    </div>

</div>
</div>
