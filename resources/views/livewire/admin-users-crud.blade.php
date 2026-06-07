<div>
<div class="dash-container">

    {{-- ── Page Header ── --}}
    <div class="dash-page-header">
        <div>
            <h4 class="dash-page-title">
                <i class="bi bi-people-fill me-2" style="color:#4f46e5;font-size:1.2rem;"></i>
                Gestion des utilisateurs
            </h4>
            <p class="dash-page-subtitle">Gérez tous les comptes et les rôles d'accès au système</p>
        </div>
        <button wire:click="openCreate"
                style="background:linear-gradient(135deg,#06BBCC,#059aaa);color:#fff;border:none;border-radius:12px;padding:11px 22px;font-family:'Nunito',sans-serif;font-weight:800;font-size:.85rem;cursor:pointer;display:inline-flex;align-items:center;gap:8px;box-shadow:0 4px 14px rgba(6,187,204,.3);transition:all .2s;"
                onmouseover="this.style.transform='translateY(-2px)'"
                onmouseout="this.style.transform=''">
            <i class="bi bi-person-plus-fill"></i> Nouvel utilisateur
        </button>
    </div>

    {{-- ── Role counts ── --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:12px;margin-bottom:24px;">
        @php
        $roleCards = [
            ['role' => 'all',        'label' => 'Total',       'icon' => 'bi-people-fill',      'color' => '#06BBCC'],
            ['role' => 'super admin','label' => 'Super Admins','icon' => 'bi-shield-fill-check', 'color' => '#ef4444'],
            ['role' => 'formateur',  'label' => 'Formateurs',  'icon' => 'bi-person-video3',     'color' => '#4f46e5'],
            ['role' => 'etudiant',   'label' => 'Étudiants',   'icon' => 'bi-mortarboard-fill',  'color' => '#10b981'],
            ['role' => 'user',       'label' => 'Utilisateurs','icon' => 'bi-person-fill',       'color' => '#64748b'],
        ];
        @endphp
        @foreach($roleCards as $rc)
        <div style="background:#fff;border-radius:14px;border:1px solid #e8edf5;padding:16px 18px;box-shadow:0 2px 10px rgba(0,0,0,.04);">
            <div style="display:flex;align-items:center;gap:10px;">
                <div style="width:36px;height:36px;border-radius:10px;background:{{ $rc['color'] }}1a;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="bi {{ $rc['icon'] }}" style="color:{{ $rc['color'] }};font-size:.9rem;"></i>
                </div>
                <div>
                    <div style="font-size:1.4rem;font-family:'Nunito',sans-serif;font-weight:900;color:#0f172a;line-height:1;">{{ $counts[$rc['role']] ?? 0 }}</div>
                    <div style="font-size:.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.4px;">{{ $rc['label'] }}</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- ── Create / Edit Form ── --}}
    @if($showForm)
    <div class="dash-card" style="margin-bottom:20px;border:2px solid rgba(6,187,204,.2);">
        <div class="dash-card-header">
            <div>
                <h6 class="dash-card-title">
                    <i class="bi bi-{{ $editId ? 'pencil-fill' : 'person-plus-fill' }} me-2" style="color:#06BBCC;"></i>
                    {{ $editId ? 'Modifier l\'utilisateur' : 'Créer un nouvel utilisateur' }}
                </h6>
                <p class="dash-card-subtitle">{{ $editId ? 'Laissez le mot de passe vide pour ne pas le modifier' : 'Le compte sera créé avec accès immédiat' }}</p>
            </div>
            <button wire:click="cancelForm"
                    style="background:none;border:none;cursor:pointer;width:32px;height:32px;border-radius:8px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-x" style="color:#64748b;font-size:1.1rem;"></i>
            </button>
        </div>
        <form wire:submit.prevent="save">
            <div class="row g-3">
                <div class="col-md-6">
                    <label style="font-family:'Nunito',sans-serif;font-weight:700;font-size:.82rem;color:#374151;display:block;margin-bottom:6px;">
                        Nom complet <span style="color:#f43f5e;">*</span>
                    </label>
                    <input wire:model="name" type="text" placeholder="Ex: Jean Kamanda"
                           style="width:100%;padding:10px 14px;border:1.5px solid #e8edf5;border-radius:10px;font-family:'Nunito',sans-serif;font-size:.875rem;outline:none;transition:border-color .15s;"
                           onfocus="this.style.borderColor='#06BBCC'"
                           onblur="this.style.borderColor='#e8edf5'">
                    @error('name')<p style="color:#f43f5e;font-size:.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>
                <div class="col-md-6">
                    <label style="font-family:'Nunito',sans-serif;font-weight:700;font-size:.82rem;color:#374151;display:block;margin-bottom:6px;">
                        Adresse email <span style="color:#f43f5e;">*</span>
                    </label>
                    <input wire:model="email" type="email" placeholder="email@cfpmoncoeur.cd"
                           style="width:100%;padding:10px 14px;border:1.5px solid #e8edf5;border-radius:10px;font-family:'Nunito',sans-serif;font-size:.875rem;outline:none;transition:border-color .15s;"
                           onfocus="this.style.borderColor='#06BBCC'"
                           onblur="this.style.borderColor='#e8edf5'">
                    @error('email')<p style="color:#f43f5e;font-size:.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>
                <div class="col-md-6">
                    <label style="font-family:'Nunito',sans-serif;font-weight:700;font-size:.82rem;color:#374151;display:block;margin-bottom:6px;">
                        Mot de passe {{ $editId ? '(vide = inchangé)' : '' }} <span style="color:#f43f5e;">{{ $editId ? '' : '*' }}</span>
                    </label>
                    <input wire:model="password" type="password" placeholder="{{ $editId ? 'Laisser vide pour ne pas modifier' : 'Minimum 6 caractères' }}"
                           style="width:100%;padding:10px 14px;border:1.5px solid #e8edf5;border-radius:10px;font-family:'Nunito',sans-serif;font-size:.875rem;outline:none;transition:border-color .15s;"
                           onfocus="this.style.borderColor='#06BBCC'"
                           onblur="this.style.borderColor='#e8edf5'">
                    @error('password')<p style="color:#f43f5e;font-size:.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>
                <div class="col-md-6">
                    <label style="font-family:'Nunito',sans-serif;font-weight:700;font-size:.82rem;color:#374151;display:block;margin-bottom:6px;">
                        Rôle <span style="color:#f43f5e;">*</span>
                    </label>
                    <select wire:model="role"
                            style="width:100%;padding:10px 14px;border:1.5px solid #e8edf5;border-radius:10px;font-family:'Nunito',sans-serif;font-size:.875rem;outline:none;transition:border-color .15s;background:#fff;"
                            onfocus="this.style.borderColor='#06BBCC'"
                            onblur="this.style.borderColor='#e8edf5'">
                        @foreach(\App\Livewire\AdminUsersCrud::ROLES as $rKey => $rInfo)
                        <option value="{{ $rKey }}">{{ $rInfo['label'] }}</option>
                        @endforeach
                    </select>
                    @error('role')<p style="color:#f43f5e;font-size:.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>
            </div>
            <div style="display:flex;align-items:center;gap:10px;margin-top:20px;padding-top:16px;border-top:1px solid #f1f5f9;">
                <button type="submit"
                        style="background:linear-gradient(135deg,#06BBCC,#059aaa);color:#fff;border:none;border-radius:10px;padding:10px 24px;font-family:'Nunito',sans-serif;font-weight:800;font-size:.85rem;cursor:pointer;display:flex;align-items:center;gap:8px;">
                    <i class="bi bi-{{ $editId ? 'check-circle-fill' : 'person-plus-fill' }}"></i>
                    {{ $editId ? 'Enregistrer' : 'Créer l\'utilisateur' }}
                </button>
                <button type="button" wire:click="cancelForm"
                        style="background:#f1f5f9;color:#64748b;border:none;border-radius:10px;padding:10px 20px;font-family:'Nunito',sans-serif;font-weight:700;font-size:.85rem;cursor:pointer;">
                    Annuler
                </button>
            </div>
        </form>
    </div>
    @endif

    {{-- ── Search ── --}}
    <div style="background:#fff;border:1px solid #e8edf5;border-radius:14px;padding:12px 16px;margin-bottom:18px;display:flex;align-items:center;gap:10px;">
        <i class="bi bi-search" style="color:#94a3b8;font-size:.9rem;flex-shrink:0;"></i>
        <input wire:model.live.debounce.400ms="searchTerm"
               type="text" placeholder="Rechercher un utilisateur par nom ou email..."
               style="flex:1;border:none;outline:none;font-family:'Nunito',sans-serif;font-size:.875rem;background:transparent;color:#0f172a;">
        @if($searchTerm)
        <button wire:click="$set('searchTerm','')" style="border:none;background:transparent;cursor:pointer;color:#94a3b8;display:flex;align-items:center;">
            <i class="bi bi-x-circle-fill"></i>
        </button>
        @endif
    </div>

    {{-- ── Users table ── --}}
    <div class="dash-card" style="margin-bottom:0;">
        <div class="dash-card-header">
            <div>
                <h6 class="dash-card-title">
                    <i class="bi bi-list-ul me-2" style="color:#4f46e5;"></i>
                    Liste des utilisateurs
                </h6>
                <p class="dash-card-subtitle">{{ $query->count() }} utilisateur(s) trouvé(s)</p>
            </div>
        </div>

        @if($query->isEmpty())
        <div class="dash-empty-state">
            <i class="bi bi-people"></i>
            <p>Aucun utilisateur trouvé.</p>
        </div>
        @else
        <div class="dash-table-wrap">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Utilisateur</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Inscrit le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($query as $i => $user)
                    @php
                        $roleInfo = \App\Livewire\AdminUsersCrud::ROLES[$user->role] ?? ['label' => $user->role, 'color' => '#64748b', 'bg' => 'rgba(100,116,139,.1)', 'icon' => 'bi-person-fill'];
                    @endphp
                    <tr>
                        <td><span class="dash-row-num">{{ $i + 1 }}</span></td>
                        <td>
                            <div class="dash-user-cell">
                                <div class="dash-avatar" style="background:{{ $roleInfo['color'] }};opacity:.85;">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <div class="dash-user-name">
                                        {{ $user->name }}
                                        @if($user->id === auth()->id())
                                            <span style="background:rgba(6,187,204,.1);color:#06BBCC;border-radius:6px;padding:2px 8px;font-size:.65rem;font-weight:800;margin-left:6px;">Vous</span>
                                        @endif
                                    </div>
                                    <div class="dash-user-sub">ID #{{ $user->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span style="display:flex;align-items:center;gap:5px;font-size:.82rem;color:#64748b;">
                                <i class="bi bi-envelope-fill" style="color:#06BBCC;"></i>
                                {{ $user->email }}
                            </span>
                        </td>
                        <td>
                            <div style="position:relative;" x-data="{ open: false }">
                                <button @click="open = !open" type="button"
                                        style="display:inline-flex;align-items:center;gap:5px;background:{{ $roleInfo['bg'] }};color:{{ $roleInfo['color'] }};border:none;border-radius:8px;padding:4px 10px;font-family:'Nunito',sans-serif;font-weight:800;font-size:.72rem;cursor:pointer;">
                                    <i class="bi {{ $roleInfo['icon'] }}" style="font-size:.7rem;"></i>
                                    {{ $roleInfo['label'] }}
                                    @if($user->id !== auth()->id())
                                    <i class="bi bi-chevron-down" style="font-size:.55rem;"></i>
                                    @endif
                                </button>
                                @if($user->id !== auth()->id())
                                <div x-show="open" @click.away="open = false" x-transition
                                     style="position:absolute;top:calc(100% + 4px);left:0;background:#fff;border:1px solid #e8edf5;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,.12);min-width:155px;overflow:hidden;z-index:100;">
                                    @foreach(\App\Livewire\AdminUsersCrud::ROLES as $rKey => $rInfo)
                                    @if($rKey !== $user->role)
                                    <button wire:click="changeRole({{ $user->id }}, '{{ $rKey }}')" @click="open = false" type="button"
                                            style="width:100%;display:flex;align-items:center;gap:8px;padding:9px 14px;border:none;background:transparent;font-family:'Nunito',sans-serif;font-weight:700;font-size:.82rem;color:#374151;cursor:pointer;transition:background .1s;"
                                            onmouseover="this.style.background='#f8fafc'"
                                            onmouseout="this.style.background='transparent'">
                                        <i class="bi {{ $rInfo['icon'] }}" style="color:{{ $rInfo['color'] }};width:16px;font-size:.8rem;"></i>
                                        {{ $rInfo['label'] }}
                                    </button>
                                    @endif
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </td>
                        <td class="dash-date-cell">
                            {{ $user->created_at->format('d/m/Y') }}
                        </td>
                        <td>
                            <div style="display:flex;align-items:center;gap:6px;">
                                <button wire:click="editAdmin({{ $user->id }})" type="button"
                                        style="width:32px;height:32px;background:rgba(79,70,229,.08);color:#4f46e5;border:none;border-radius:8px;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .15s;"
                                        onmouseover="this.style.background='#4f46e5';this.style.color='#fff'"
                                        onmouseout="this.style.background='rgba(79,70,229,.08)';this.style.color='#4f46e5'"
                                        title="Modifier">
                                    <i class="bi bi-pencil-fill" style="font-size:.75rem;"></i>
                                </button>
                                @if($user->id !== auth()->id())
                                <button wire:click="deleteAdmin({{ $user->id }})"
                                        wire:confirm="Supprimer cet utilisateur ? Cette action est irréversible."
                                        type="button"
                                        style="width:32px;height:32px;background:rgba(244,63,94,.08);color:#f43f5e;border:none;border-radius:8px;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .15s;"
                                        onmouseover="this.style.background='#f43f5e';this.style.color='#fff'"
                                        onmouseout="this.style.background='rgba(244,63,94,.08)';this.style.color='#f43f5e'"
                                        title="Supprimer">
                                    <i class="bi bi-trash3-fill" style="font-size:.75rem;"></i>
                                </button>
                                @else
                                <div style="width:32px;height:32px;background:#f8fafc;border-radius:8px;display:flex;align-items:center;justify-content:center;" title="Votre compte">
                                    <i class="bi bi-lock-fill" style="font-size:.75rem;color:#94a3b8;"></i>
                                </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

</div>
</div>
