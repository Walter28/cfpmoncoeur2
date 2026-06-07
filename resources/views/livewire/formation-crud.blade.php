<div>

    @if(session()->has('message'))
    <div style="background:linear-gradient(135deg,#d1fae5,#a7f3d0);border:1px solid #6ee7b7;border-radius:12px;padding:14px 20px;margin-bottom:20px;display:flex;align-items:center;gap:10px;">
        <i class="bi bi-check-circle-fill" style="color:#059669;font-size:1.1rem;flex-shrink:0;"></i>
        <span style="font-family:'Nunito',sans-serif;font-weight:700;color:#065f46;">{{ session('message') }}</span>
    </div>
    @endif

    {{-- ── Page Header ── --}}
    <div class="dash-page-header">
        <div>
            <h4 class="dash-page-title">
                <i class="bi bi-book-fill me-2" style="color:#06BBCC;font-size:1.2rem;"></i>
                Gestion des formations
            </h4>
            <p class="dash-page-subtitle">Créez, publiez et gérez tous vos programmes de formation</p>
        </div>
        <button wire:click="resetFormAndOpen"
                style="background:linear-gradient(135deg,#06BBCC,#059aaa);color:#fff;border:none;border-radius:12px;padding:11px 22px;font-family:'Nunito',sans-serif;font-weight:800;font-size:.85rem;cursor:pointer;display:inline-flex;align-items:center;gap:8px;box-shadow:0 4px 14px rgba(6,187,204,.3);transition:all .2s;"
                onmouseover="this.style.transform='translateY(-2px)'"
                onmouseout="this.style.transform=''">
            <i class="bi bi-plus-lg"></i> Nouvelle formation
        </button>
    </div>

    {{-- ── Status Tabs ── --}}
    <div style="display:flex;align-items:center;gap:6px;flex-wrap:wrap;margin-bottom:20px;background:#fff;border:1px solid #e8edf5;border-radius:14px;padding:6px;">
        @php
        $tabs = [
            ['key' => 'all',       'label' => 'Toutes',     'icon' => 'bi-grid-fill',        'color' => '#06BBCC'],
            ['key' => 'publiee',   'label' => 'Publiées',   'icon' => 'bi-check-circle-fill', 'color' => '#10b981'],
            ['key' => 'brouillon', 'label' => 'Brouillons', 'icon' => 'bi-pencil-fill',        'color' => '#64748b'],
            ['key' => 'suspendue', 'label' => 'Suspendues', 'icon' => 'bi-pause-circle-fill',  'color' => '#f59e0b'],
            ['key' => 'archivee',  'label' => 'Archivées',  'icon' => 'bi-archive-fill',       'color' => '#ef4444'],
        ];
        @endphp
        @foreach($tabs as $tab)
        <button wire:click="$set('filterStatut', '{{ $tab['key'] }}')"
                style="display:inline-flex;align-items:center;gap:7px;padding:8px 16px;border:none;border-radius:10px;font-family:'Nunito',sans-serif;font-weight:800;font-size:.82rem;cursor:pointer;transition:all .15s;
                    {{ $filterStatut === $tab['key']
                        ? 'background:'.$tab['color'].';color:#fff;box-shadow:0 4px 12px rgba(0,0,0,.15);'
                        : 'background:transparent;color:#64748b;' }}">
            <i class="bi {{ $tab['icon'] }}"></i>
            {{ $tab['label'] }}
            <span style="display:inline-flex;align-items:center;justify-content:center;min-width:20px;height:20px;border-radius:6px;font-size:.7rem;padding:0 5px;
                {{ $filterStatut === $tab['key'] ? 'background:rgba(255,255,255,.25);color:#fff;' : 'background:#f1f5f9;color:#64748b;' }}">
                {{ $counts[$tab['key']] ?? 0 }}
            </span>
        </button>
        @endforeach
    </div>

    {{-- ── Search ── --}}
    <div style="background:#fff;border:1px solid #e8edf5;border-radius:14px;padding:14px 18px;margin-bottom:24px;display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
        <div style="flex:1;min-width:200px;position:relative;">
            <i class="bi bi-search" style="position:absolute;left:13px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:.9rem;pointer-events:none;"></i>
            <input wire:model.live.debounce.400ms="searchTerm"
                   type="text" placeholder="Rechercher par titre, catégorie ou formateur..."
                   style="width:100%;padding:10px 14px 10px 38px;border:1.5px solid #e8edf5;border-radius:10px;font-family:'Nunito',sans-serif;font-size:.875rem;outline:none;transition:border-color .15s;"
                   onfocus="this.style.borderColor='#06BBCC'"
                   onblur="this.style.borderColor='#e8edf5'">
        </div>
        @if($searchTerm)
        <button wire:click="$set('searchTerm','')"
                style="padding:10px 16px;border:1.5px solid #e8edf5;border-radius:10px;font-family:'Nunito',sans-serif;font-size:.82rem;font-weight:700;color:#64748b;background:#fff;cursor:pointer;display:inline-flex;align-items:center;gap:6px;">
            <i class="bi bi-x-circle"></i> Effacer
        </button>
        @endif
    </div>

    {{-- ── Grid of formations ── --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(310px,1fr));gap:20px;margin-bottom:28px;">
        @forelse($formations as $formation)
        @php
            $si         = $formation->statut_info;
            $inscCount  = $formation->inscriptions->count();
        @endphp
        <div style="background:#fff;border-radius:18px;border:1px solid #e8edf5;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.05);transition:all .2s;display:flex;flex-direction:column;"
             onmouseover="this.style.boxShadow='0 8px 30px rgba(0,0,0,.1)';this.style.transform='translateY(-2px)'"
             onmouseout="this.style.boxShadow='0 2px 12px rgba(0,0,0,.05)';this.style.transform=''">

            {{-- Cover Image --}}
            <div style="height:175px;background:linear-gradient(135deg,#0f172a,#1e3a5f);position:relative;overflow:hidden;flex-shrink:0;">
                @if($formation->photo && \Illuminate\Support\Facades\Storage::disk('public')->exists($formation->photo))
                    <img src="{{ asset('storage/'.$formation->photo) }}" alt="{{ $formation->titre }}"
                         style="width:100%;height:100%;object-fit:cover;opacity:.85;">
                @else
                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-book-half" style="font-size:3rem;color:rgba(6,187,204,.4);"></i>
                    </div>
                @endif
                {{-- Statut badge --}}
                <div style="position:absolute;top:10px;left:10px;display:inline-flex;align-items:center;gap:5px;background:rgba(15,23,42,.8);backdrop-filter:blur(6px);border:1px solid rgba(255,255,255,.1);border-radius:8px;padding:4px 10px;">
                    <i class="bi {{ $si['icon'] }}" style="color:{{ $si['color'] }};font-size:.72rem;"></i>
                    <span style="font-family:'Nunito',sans-serif;font-weight:800;font-size:.7rem;color:{{ $si['color'] }};text-transform:uppercase;letter-spacing:.5px;">{{ $si['label'] }}</span>
                </div>
                {{-- Prix badge --}}
                <div style="position:absolute;top:10px;right:10px;background:rgba(15,23,42,.8);backdrop-filter:blur(6px);border:1px solid rgba(255,255,255,.1);border-radius:8px;padding:4px 10px;">
                    <span style="font-family:'Nunito',sans-serif;font-weight:900;font-size:.8rem;color:#fff;">
                        @if(!$formation->prix || $formation->prix == 0)
                            <i class="bi bi-gift-fill me-1" style="color:#10b981;"></i>Gratuit
                        @else
                            {{ number_format($formation->prix, 0, ',', ' ') }} $
                        @endif
                    </span>
                </div>
            </div>

            {{-- Content --}}
            <div style="padding:18px 20px;flex:1;display:flex;flex-direction:column;">
                {{-- Badges --}}
                <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:10px;">
                    @if($formation->categorie)
                    <span style="display:inline-flex;align-items:center;gap:4px;background:rgba(6,187,204,.08);color:#0694a2;border-radius:6px;padding:3px 9px;font-size:.7rem;font-weight:800;">
                        <i class="bi bi-tag-fill"></i> {{ $formation->categorie }}
                    </span>
                    @endif
                    @if($formation->niveau)
                    <span style="display:inline-flex;align-items:center;gap:4px;background:rgba(79,70,229,.08);color:#4f46e5;border-radius:6px;padding:3px 9px;font-size:.7rem;font-weight:800;">
                        <i class="bi bi-bar-chart-fill"></i> {{ $formation->niveau }}
                    </span>
                    @endif
                </div>

                <h5 style="font-family:'Nunito',sans-serif;font-weight:900;font-size:.95rem;color:#0f172a;margin:0 0 8px;line-height:1.35;">{{ $formation->titre }}</h5>

                <p style="font-size:.8rem;color:#64748b;margin:0 0 14px;line-height:1.5;flex:1;">
                    {{ Str::limit($formation->description, 85) }}
                </p>

                {{-- Meta grid --}}
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:6px;margin-bottom:16px;">
                    <div style="display:flex;align-items:center;gap:6px;">
                        <div style="width:24px;height:24px;background:rgba(6,187,204,.1);border-radius:6px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="bi bi-person-fill" style="color:#06BBCC;font-size:.65rem;"></i>
                        </div>
                        <span style="font-size:.76rem;color:#475569;font-weight:700;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $formation->formateur?->prenom ?? '' }} {{ $formation->formateur?->nom ?? 'N/A' }}</span>
                    </div>
                    <div style="display:flex;align-items:center;gap:6px;">
                        <div style="width:24px;height:24px;background:rgba(245,158,11,.1);border-radius:6px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="bi bi-clock-fill" style="color:#f59e0b;font-size:.65rem;"></i>
                        </div>
                        <span style="font-size:.76rem;color:#475569;font-weight:700;">{{ $formation->duree ?? 'N/A' }}</span>
                    </div>
                    <div style="display:flex;align-items:center;gap:6px;">
                        <div style="width:24px;height:24px;background:rgba(16,185,129,.1);border-radius:6px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="bi bi-people-fill" style="color:#10b981;font-size:.65rem;"></i>
                        </div>
                        <span style="font-size:.76rem;color:#475569;font-weight:700;">{{ $inscCount }} inscrit(s)</span>
                    </div>
                    <div style="display:flex;align-items:center;gap:6px;">
                        <div style="width:24px;height:24px;background:rgba(79,70,229,.1);border-radius:6px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="bi bi-geo-alt-fill" style="color:#4f46e5;font-size:.65rem;"></i>
                        </div>
                        <span style="font-size:.76rem;color:#475569;font-weight:700;">{{ Str::limit($formation->lieu ?? 'N/A', 14) }}</span>
                    </div>
                </div>

                {{-- Action bar --}}
                <div style="display:flex;gap:7px;border-top:1px solid #f1f5f9;padding-top:14px;align-items:center;">
                    {{-- Edit button --}}
                    <button wire:click="editFormation({{ $formation->id }})"
                            style="flex:1;display:inline-flex;align-items:center;justify-content:center;gap:5px;padding:8px 10px;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;font-family:'Nunito',sans-serif;font-weight:800;font-size:.78rem;color:#334155;cursor:pointer;transition:all .15s;"
                            onmouseover="this.style.background='#06BBCC';this.style.borderColor='#06BBCC';this.style.color='#fff'"
                            onmouseout="this.style.background='#f8fafc';this.style.borderColor='#e2e8f0';this.style.color='#334155'">
                        <i class="bi bi-pencil-fill"></i> Modifier
                    </button>

                    {{-- Change statut dropdown --}}
                    <div style="position:relative;" x-data="{ open: false }">
                        <button @click="open = !open" type="button"
                                style="display:inline-flex;align-items:center;gap:5px;padding:8px 10px;background:{{ $si['bg'] }};border:1.5px solid transparent;border-radius:9px;font-family:'Nunito',sans-serif;font-weight:800;font-size:.78rem;color:{{ $si['color'] }};cursor:pointer;white-space:nowrap;">
                            <i class="bi {{ $si['icon'] }}"></i>
                            <span class="d-none d-lg-inline">{{ $si['label'] }}</span>
                            <i class="bi bi-chevron-down" style="font-size:.58rem;"></i>
                        </button>
                        <div x-show="open" @click.away="open = false" x-transition
                             style="position:absolute;bottom:calc(100% + 6px);right:0;background:#fff;border:1px solid #e8edf5;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,.12);min-width:155px;overflow:hidden;z-index:100;">
                            @foreach(\App\Models\Formation::STATUTS as $sKey => $sInfo)
                            @if($sKey !== $formation->statut)
                            <button wire:click="changeStatut({{ $formation->id }}, '{{ $sKey }}')" @click="open = false" type="button"
                                    style="width:100%;display:flex;align-items:center;gap:8px;padding:10px 14px;border:none;background:transparent;font-family:'Nunito',sans-serif;font-weight:700;font-size:.82rem;color:#374151;cursor:pointer;transition:background .1s;"
                                    onmouseover="this.style.background='#f8fafc'"
                                    onmouseout="this.style.background='transparent'">
                                <i class="bi {{ $sInfo['icon'] }}" style="color:{{ $sInfo['color'] }};width:16px;"></i>
                                {{ $sInfo['label'] }}
                            </button>
                            @endif
                            @endforeach
                        </div>
                    </div>

                    {{-- Delete --}}
                    <button onclick="if(!confirm('Supprimer définitivement cette formation ?')) return false;"
                            wire:click="deleteFormation({{ $formation->id }})" type="button"
                            style="display:inline-flex;align-items:center;justify-content:center;padding:8px 10px;background:#fff5f5;border:1.5px solid #fecaca;border-radius:9px;font-family:'Nunito',sans-serif;font-size:.78rem;color:#ef4444;cursor:pointer;transition:all .15s;"
                            onmouseover="this.style.background='#ef4444';this.style.borderColor='#ef4444';this.style.color='#fff'"
                            onmouseout="this.style.background='#fff5f5';this.style.borderColor='#fecaca';this.style.color='#ef4444'">
                        <i class="bi bi-trash3-fill"></i>
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div style="grid-column:1/-1;text-align:center;padding:60px 20px;background:#fff;border-radius:18px;border:1px solid #e8edf5;">
            <div style="width:72px;height:72px;background:rgba(6,187,204,.1);border-radius:20px;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
                <i class="bi bi-book-fill" style="font-size:2rem;color:#06BBCC;"></i>
            </div>
            <h5 style="font-family:'Nunito',sans-serif;font-weight:900;color:#0f172a;margin-bottom:8px;">Aucune formation trouvée</h5>
            <p style="color:#94a3b8;font-size:.875rem;margin-bottom:20px;">
                @if($searchTerm)
                    Aucun résultat pour "{{ $searchTerm }}". Essayez un autre terme.
                @elseif($filterStatut !== 'all')
                    Aucune formation avec ce statut pour l'instant.
                @else
                    Commencez par créer votre première formation.
                @endif
            </p>
            @if(!$searchTerm)
            <button wire:click="resetFormAndOpen"
                    style="background:linear-gradient(135deg,#06BBCC,#059aaa);color:#fff;border:none;border-radius:12px;padding:11px 24px;font-family:'Nunito',sans-serif;font-weight:800;font-size:.875rem;cursor:pointer;display:inline-flex;align-items:center;gap:8px;box-shadow:0 4px 14px rgba(6,187,204,.3);">
                <i class="bi bi-plus-lg"></i> Créer une formation
            </button>
            @endif
        </div>
        @endforelse
    </div>

    {{-- ── Pagination ── --}}
    @if($formations->hasPages())
    <div style="display:flex;justify-content:center;margin-bottom:20px;">
        {{ $formations->links('livewire::bootstrap') }}
    </div>
    @endif

    {{-- ════════════════ MODAL CREATE / EDIT ════════════════ --}}
    <div class="modal fade" id="formationModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content" style="border-radius:20px;border:none;overflow:hidden;">
                <form wire:submit.prevent="{{ $editMode ? 'updateFormation' : 'addFormation' }}" enctype="multipart/form-data">

                    {{-- Header --}}
                    <div style="background:linear-gradient(135deg,#0f172a,#1a2a4a);padding:22px 28px;display:flex;align-items:center;justify-content:space-between;">
                        <div style="display:flex;align-items:center;gap:12px;">
                            <div style="width:40px;height:40px;background:rgba(6,187,204,.2);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                                <i class="bi {{ $editMode ? 'bi-pencil-fill' : 'bi-plus-circle-fill' }}" style="color:#06BBCC;font-size:1rem;"></i>
                            </div>
                            <div>
                                <h5 style="color:#fff;font-family:'Nunito',sans-serif;font-weight:900;margin:0;font-size:1rem;">
                                    {{ $editMode ? 'Modifier la formation' : 'Nouvelle formation' }}
                                </h5>
                                <p style="color:rgba(255,255,255,.5);font-size:.75rem;margin:0;">Remplissez les informations ci-dessous</p>
                            </div>
                        </div>
                        <button type="button" data-bs-dismiss="modal"
                                style="width:32px;height:32px;border-radius:8px;background:rgba(255,255,255,.1);border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-x" style="color:#fff;font-size:1.2rem;"></i>
                        </button>
                    </div>

                    {{-- Body --}}
                    <div class="modal-body" style="padding:28px;background:#f8fafc;">
                        <div class="row g-4">

                            {{-- Section A: Infos générales --}}
                            <div class="col-12">
                                <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;padding-bottom:10px;border-bottom:1px solid #e8edf5;">
                                    <div style="width:28px;height:28px;background:rgba(6,187,204,.12);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                        <i class="bi bi-info-circle-fill" style="color:#06BBCC;font-size:.8rem;"></i>
                                    </div>
                                    <span style="font-family:'Nunito',sans-serif;font-weight:900;font-size:.88rem;color:#0f172a;">Informations générales</span>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold" style="font-size:.82rem;color:#374151;">Titre de la formation <span style="color:#ef4444;">*</span></label>
                                <input wire:model.live="titre" type="text" placeholder="Ex : Formation Laravel 12 — Du débutant à l'expert"
                                       class="form-control @error('titre') is-invalid @enderror"
                                       style="border-radius:10px;border:1.5px solid #e8edf5;font-family:'Nunito',sans-serif;">
                                @error('titre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold" style="font-size:.82rem;color:#374151;">Catégorie</label>
                                <select wire:model.live="categorie"
                                        class="form-select @error('categorie') is-invalid @enderror"
                                        style="border-radius:10px;border:1.5px solid #e8edf5;font-family:'Nunito',sans-serif;">
                                    <option value="">Sélectionner une catégorie</option>
                                    @foreach(\App\Models\Formation::CATEGORIES as $cat)
                                    <option value="{{ $cat }}">{{ $cat }}</option>
                                    @endforeach
                                </select>
                                @error('categorie')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold" style="font-size:.82rem;color:#374151;">Niveau</label>
                                <select wire:model.live="niveau"
                                        class="form-select @error('niveau') is-invalid @enderror"
                                        style="border-radius:10px;border:1.5px solid #e8edf5;font-family:'Nunito',sans-serif;">
                                    <option value="">Sélectionner un niveau</option>
                                    @foreach(\App\Models\Formation::NIVEAUX as $niv)
                                    <option value="{{ $niv }}">{{ $niv }}</option>
                                    @endforeach
                                </select>
                                @error('niveau')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold" style="font-size:.82rem;color:#374151;">Statut <span style="color:#ef4444;">*</span></label>
                                <select wire:model.live="statut"
                                        class="form-select @error('statut') is-invalid @enderror"
                                        style="border-radius:10px;border:1.5px solid #e8edf5;font-family:'Nunito',sans-serif;">
                                    @foreach(\App\Models\Formation::STATUTS as $sKey => $sInfo)
                                    <option value="{{ $sKey }}">{{ $sInfo['label'] }}</option>
                                    @endforeach
                                </select>
                                @error('statut')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold" style="font-size:.82rem;color:#374151;">Formateur <span style="color:#ef4444;">*</span></label>
                                <select wire:model.live="formateur_id"
                                        class="form-select @error('formateur_id') is-invalid @enderror"
                                        style="border-radius:10px;border:1.5px solid #e8edf5;font-family:'Nunito',sans-serif;">
                                    <option value="">Sélectionner un formateur</option>
                                    @foreach($formateurs as $f)
                                    <option value="{{ $f->id }}">{{ $f->prenom }} {{ $f->nom }}{{ $f->domaine ? ' — '.$f->domaine : '' }}</option>
                                    @endforeach
                                </select>
                                @error('formateur_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold" style="font-size:.82rem;color:#374151;">Description <span style="color:#ef4444;">*</span></label>
                                <textarea wire:model.live="description" rows="4"
                                          placeholder="Décrivez le contenu, les objectifs et les bénéfices de cette formation..."
                                          class="form-control @error('description') is-invalid @enderror"
                                          style="border-radius:10px;border:1.5px solid #e8edf5;font-family:'Nunito',sans-serif;resize:vertical;"></textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold" style="font-size:.82rem;color:#374151;">Objectifs pédagogiques</label>
                                <textarea wire:model.live="objectif" rows="3"
                                          placeholder="À la fin de cette formation, l'étudiant sera capable de..."
                                          class="form-control @error('objectif') is-invalid @enderror"
                                          style="border-radius:10px;border:1.5px solid #e8edf5;font-family:'Nunito',sans-serif;resize:vertical;"></textarea>
                                @error('objectif')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            {{-- Section B: Détails pratiques --}}
                            <div class="col-12">
                                <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;padding-bottom:10px;border-bottom:1px solid #e8edf5;">
                                    <div style="width:28px;height:28px;background:rgba(79,70,229,.1);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                        <i class="bi bi-calendar-event-fill" style="color:#4f46e5;font-size:.8rem;"></i>
                                    </div>
                                    <span style="font-family:'Nunito',sans-serif;font-weight:900;font-size:.88rem;color:#0f172a;">Détails pratiques</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold" style="font-size:.82rem;color:#374151;">Prérequis</label>
                                <input wire:model.live="prerequis" type="text" placeholder="Ex : Bases en informatique"
                                       class="form-control @error('prerequis') is-invalid @enderror"
                                       style="border-radius:10px;border:1.5px solid #e8edf5;font-family:'Nunito',sans-serif;">
                                @error('prerequis')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold" style="font-size:.82rem;color:#374151;">Durée</label>
                                <input wire:model.live="duree" type="text" placeholder="Ex : 6 semaines"
                                       class="form-control @error('duree') is-invalid @enderror"
                                       style="border-radius:10px;border:1.5px solid #e8edf5;font-family:'Nunito',sans-serif;">
                                @error('duree')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold" style="font-size:.82rem;color:#374151;">Lieu</label>
                                <input wire:model.live="lieu" type="text" placeholder="Ex : Goma, RDC"
                                       class="form-control @error('lieu') is-invalid @enderror"
                                       style="border-radius:10px;border:1.5px solid #e8edf5;font-family:'Nunito',sans-serif;">
                                @error('lieu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold" style="font-size:.82rem;color:#374151;">Session</label>
                                <input wire:model.live="session" type="text" placeholder="Ex : 2025-A"
                                       class="form-control @error('session') is-invalid @enderror"
                                       style="border-radius:10px;border:1.5px solid #e8edf5;font-family:'Nunito',sans-serif;">
                                @error('session')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold" style="font-size:.82rem;color:#374151;">Date de début</label>
                                <input wire:model.live="date_debut" type="date"
                                       class="form-control @error('date_debut') is-invalid @enderror"
                                       style="border-radius:10px;border:1.5px solid #e8edf5;font-family:'Nunito',sans-serif;">
                                @error('date_debut')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold" style="font-size:.82rem;color:#374151;">Date de fin</label>
                                <input wire:model.live="date_fin" type="date"
                                       class="form-control @error('date_fin') is-invalid @enderror"
                                       style="border-radius:10px;border:1.5px solid #e8edf5;font-family:'Nunito',sans-serif;">
                                @error('date_fin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold" style="font-size:.82rem;color:#374151;">Prix ($) <span style="color:#ef4444;">*</span></label>
                                <div style="position:relative;">
                                    <span style="position:absolute;left:13px;top:50%;transform:translateY(-50%);color:#94a3b8;font-weight:800;pointer-events:none;">$</span>
                                    <input wire:model.live="prix" type="number" step="0.01" min="0" placeholder="0 pour gratuit"
                                           class="form-control @error('prix') is-invalid @enderror"
                                           style="border-radius:10px;border:1.5px solid #e8edf5;font-family:'Nunito',sans-serif;padding-left:30px;">
                                </div>
                                @error('prix')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold" style="font-size:.82rem;color:#374151;">Vidéo de présentation (URL)</label>
                                <input wire:model.live="video" type="text" placeholder="https://youtube.com/..."
                                       class="form-control @error('video') is-invalid @enderror"
                                       style="border-radius:10px;border:1.5px solid #e8edf5;font-family:'Nunito',sans-serif;">
                                @error('video')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            {{-- Photo --}}
                            <div class="col-12">
                                <label class="form-label fw-bold" style="font-size:.82rem;color:#374151;">
                                    Photo de couverture
                                    @if($editMode && $photo_old)
                                    <small class="text-muted fw-normal">(laisser vide pour conserver l'actuelle)</small>
                                    @endif
                                </label>
                                <input wire:model.live="photo" type="file" accept="image/*"
                                       class="form-control @error('photo') is-invalid @enderror"
                                       style="border-radius:10px;border:1.5px solid #e8edf5;font-family:'Nunito',sans-serif;">
                                @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror

                                @if($photo)
                                <div style="margin-top:10px;">
                                    <img src="{{ $photo->temporaryUrl() }}" style="height:80px;border-radius:10px;object-fit:cover;border:2px solid #e8edf5;" alt="Aperçu">
                                </div>
                                @elseif($editMode && $photo_old && \Illuminate\Support\Facades\Storage::disk('public')->exists($photo_old))
                                <div style="margin-top:10px;">
                                    <img src="{{ asset('storage/'.$photo_old) }}" style="height:80px;border-radius:10px;object-fit:cover;border:2px solid #e8edf5;" alt="Photo actuelle">
                                </div>
                                @endif
                            </div>

                        </div>
                    </div>

                    {{-- Footer --}}
                    <div style="padding:20px 28px;background:#fff;border-top:1px solid #f1f5f9;display:flex;align-items:center;justify-content:flex-end;gap:12px;">
                        <button type="button" data-bs-dismiss="modal"
                                style="padding:10px 22px;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:10px;font-family:'Nunito',sans-serif;font-weight:800;font-size:.875rem;color:#475569;cursor:pointer;">
                            Annuler
                        </button>
                        <button type="submit"
                                style="padding:10px 28px;background:linear-gradient(135deg,#06BBCC,#059aaa);border:none;border-radius:10px;font-family:'Nunito',sans-serif;font-weight:800;font-size:.875rem;color:#fff;cursor:pointer;display:inline-flex;align-items:center;gap:8px;box-shadow:0 4px 14px rgba(6,187,204,.3);">
                            <i class="bi {{ $editMode ? 'bi-check-circle-fill' : 'bi-plus-circle-fill' }}"></i>
                            {{ $editMode ? 'Enregistrer les modifications' : 'Créer la formation' }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('openModal', () => {
                const m = new bootstrap.Modal(document.getElementById('formationModal'));
                m.show();
            });
            Livewire.on('closeModal', () => {
                const m = bootstrap.Modal.getInstance(document.getElementById('formationModal'));
                if (m) m.hide();
            });
        });
        document.getElementById('formationModal')?.addEventListener('hidden.bs.modal', () => {
            Livewire.dispatch('resetForm');
        });
    </script>
    @endpush
</div>
