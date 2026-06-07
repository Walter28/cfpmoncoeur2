<div>

{{-- ══════════════════════════════════════════════════════
     MON PROFIL — layout frontend CFP Mon Cœur
══════════════════════════════════════════════════════ --}}

<style>
.profil-page { background: var(--cfp-bg, #f4f7fb); min-height: 80vh; padding-bottom: 64px; }

/* Hero bande */
.profil-hero {
    background: linear-gradient(135deg, #0f172a 0%, #181d38 55%, #0d1c3a 100%);
    padding: 56px 0 80px;
    position: relative;
    overflow: hidden;
}
.profil-hero::before {
    content: '';
    position: absolute; top: -80px; right: -80px;
    width: 320px; height: 320px;
    background: rgba(6,187,204,.07);
}
.profil-hero::after {
    content: '';
    position: absolute; bottom: -60px; left: -60px;
    width: 240px; height: 240px;
    background: rgba(79,70,229,.05);
}

/* Avatar initiales */
.profil-avatar {
    width: 96px; height: 96px;
    background: linear-gradient(135deg, #06BBCC, #4f46e5);
    display: flex; align-items: center; justify-content: center;
    font-family: 'Nunito', sans-serif;
    font-weight: 900; color: #fff;
    font-size: 2.2rem;
    border: 3px solid rgba(255,255,255,.15);
    margin: 0 auto 20px;
    box-shadow: 0 8px 32px rgba(6,187,204,.25);
}

/* Carte sections */
.profil-card {
    background: var(--cfp-card, #fff);
    border: 1px solid var(--cfp-border, rgba(0,0,0,.07));
    box-shadow: 0 2px 16px rgba(15,23,42,.06);
    overflow: hidden;
}
.profil-card-header {
    padding: 24px 28px 0;
    display: flex; align-items: center; gap: 12px;
    margin-bottom: 20px;
}
.profil-card-icon {
    width: 40px; height: 40px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.05rem;
}
.profil-card-body { padding: 0 28px 28px; }

/* Inputs */
.profil-input {
    width: 100%;
    padding: 12px 16px;
    border: 1.5px solid var(--cfp-input-border, #e2e8f0);
    background: var(--cfp-input-bg, #fafbfc);
    font-size: .9rem;
    font-family: 'Nunito', sans-serif;
    color: var(--cfp-text, #0f172a);
    outline: none;
    transition: border-color .15s, box-shadow .15s;
}
.profil-input:focus {
    border-color: #06BBCC;
    box-shadow: 0 0 0 3px rgba(6,187,204,.1);
    background: var(--cfp-card, #fff);
}

/* Labels */
.profil-label {
    display: block;
    font-size: .78rem;
    font-weight: 700;
    color: var(--cfp-muted, #64748b);
    margin-bottom: 7px;
    letter-spacing: .04em;
    text-transform: uppercase;
}

/* Buttons */
.profil-btn {
    padding: 13px 28px;
    font-family: 'Nunito', sans-serif;
    font-weight: 800;
    font-size: .88rem;
    border: none;
    cursor: pointer;
    transition: transform .15s, opacity .15s, box-shadow .15s;
    letter-spacing: .01em;
    display: inline-flex; align-items: center; gap: 8px;
}
.profil-btn:hover { opacity: .92; transform: translateY(-2px); }
.profil-btn:active { transform: translateY(0); }
.profil-btn-primary {
    background: linear-gradient(135deg, #06BBCC, #059aaa);
    color: #fff;
    box-shadow: 0 4px 16px rgba(6,187,204,.3);
}
.profil-btn-primary:hover { box-shadow: 0 8px 24px rgba(6,187,204,.4); }
.profil-btn-dark {
    background: linear-gradient(135deg, #181d38, #0f172a);
    color: #fff;
    box-shadow: 0 4px 14px rgba(15,23,42,.2);
}

/* Alerts */
.profil-alert {
    padding: 13px 16px;
    display: flex; align-items: center; gap: 10px;
    font-size: .85rem;
    font-weight: 700;
    margin-bottom: 20px;
    border-width: 1px;
    border-style: solid;
}
.profil-alert-ok  { background: #f0fdf4; border-color: #bbf7d0; color: #166534; }
.profil-alert-err { background: #fef2f2; border-color: #fecaca; color: #991b1b; }

/* Badge rôle */
.profil-role-badge {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 6px 16px;
    font-size: .8rem; font-weight: 800;
    border-width: 1px; border-style: solid;
    letter-spacing: .03em;
}

/* Séparateur */
.profil-divider { height: 1px; background: var(--cfp-border, rgba(0,0,0,.07)); margin: 0 28px; }

/* Stats bas */
.profil-stat-row {
    padding: 20px 28px;
    display: flex; align-items: center; flex-wrap: wrap; gap: 20px;
}
.profil-stat-item { display: flex; align-items: center; gap: 8px; }
.profil-stat-sep { width: 1px; height: 22px; background: var(--cfp-border, rgba(0,0,0,.07)); }
.profil-stat-text { font-size: .84rem; color: var(--cfp-muted, #64748b); font-weight: 600; }

/* Dark mode overrides */
[data-theme="dark"] .profil-card {
    background: var(--cfp-card) !important;
    border-color: var(--cfp-border) !important;
}
[data-theme="dark"] .profil-input {
    background: var(--cfp-input-bg) !important;
    border-color: var(--cfp-input-border) !important;
    color: var(--cfp-text) !important;
}
[data-theme="dark"] .profil-label { color: var(--cfp-muted) !important; }
[data-theme="dark"] .profil-stat-text { color: var(--cfp-muted) !important; }
</style>

<div class="profil-page">

    {{-- ── HERO ── --}}
    <div class="profil-hero">
        <div class="container" style="position:relative;z-index:1;text-align:center;">

            <div class="profil-avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
            </div>

            <h2 style="font-family:'Nunito',sans-serif;font-weight:900;color:#fff;margin-bottom:4px;font-size:1.7rem;">
                {{ auth()->user()->name }}
            </h2>
            <p style="color:rgba(255,255,255,.55);font-size:.9rem;margin-bottom:16px;">
                {{ auth()->user()->email }}
            </p>

            @php $role = auth()->user()->role ?? 'user'; @endphp
            @if($role === 'super admin')
                <span class="profil-role-badge" style="background:rgba(245,158,11,.15);color:#f59e0b;border-color:rgba(245,158,11,.35);">
                    <i class="bi bi-shield-fill-check"></i> Super Administrateur
                </span>
            @elseif($role === 'formateur')
                <span class="profil-role-badge" style="background:rgba(6,187,204,.15);color:#06BBCC;border-color:rgba(6,187,204,.35);">
                    <i class="bi bi-person-video3"></i> Formateur
                </span>
            @elseif($role === 'etudiant')
                <span class="profil-role-badge" style="background:rgba(16,185,129,.15);color:#10b981;border-color:rgba(16,185,129,.35);">
                    <i class="bi bi-mortarboard-fill"></i> Étudiant
                </span>
            @else
                <span class="profil-role-badge" style="background:rgba(100,116,139,.15);color:#94a3b8;border-color:rgba(100,116,139,.35);">
                    <i class="bi bi-person-fill"></i> Utilisateur
                </span>
            @endif

            <p style="color:rgba(255,255,255,.35);font-size:.78rem;margin-top:14px;margin-bottom:0;">
                <i class="bi bi-calendar3 me-1"></i>
                Membre depuis {{ auth()->user()->created_at->locale('fr')->isoFormat('MMMM YYYY') }}
            </p>
        </div>
    </div>

    {{-- ── CARTES ── --}}
    <div class="container" style="max-width:900px;margin-top:-40px;position:relative;z-index:2;">

        <div class="row g-4">

            {{-- ── Informations du profil ── --}}
            <div class="col-lg-6">
                <div class="profil-card h-100">
                    <div class="profil-card-header">
                        <div class="profil-card-icon" style="background:rgba(6,187,204,.1);">
                            <i class="bi bi-person-fill" style="color:#06BBCC;"></i>
                        </div>
                        <div>
                            <h6 style="font-family:'Nunito',sans-serif;font-weight:800;color:var(--cfp-text,#0f172a);margin:0;font-size:.95rem;">Informations du profil</h6>
                            <p style="color:var(--cfp-muted,#64748b);font-size:.78rem;margin:2px 0 0;">Nom et adresse email</p>
                        </div>
                    </div>

                    <div class="profil-divider"></div>
                    <div class="profil-card-body" style="padding-top:24px;">

                        @if($profileSuccess)
                            <div class="profil-alert profil-alert-ok">
                                <i class="bi bi-check-circle-fill"></i> {{ $profileSuccess }}
                            </div>
                        @endif
                        @if($profileError)
                            <div class="profil-alert profil-alert-err">
                                <i class="bi bi-exclamation-circle-fill"></i> {{ $profileError }}
                            </div>
                        @endif

                        <div style="margin-bottom:18px;">
                            <label class="profil-label"><i class="bi bi-person me-1"></i>Nom complet</label>
                            <input wire:model="name" type="text" class="profil-input" placeholder="Votre nom complet">
                            @error('name')<span style="color:#ef4444;font-size:.78rem;margin-top:5px;display:block;"><i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}</span>@enderror
                        </div>

                        <div style="margin-bottom:28px;">
                            <label class="profil-label"><i class="bi bi-envelope me-1"></i>Adresse email</label>
                            <input wire:model="email" type="email" class="profil-input" placeholder="Votre email">
                            @error('email')<span style="color:#ef4444;font-size:.78rem;margin-top:5px;display:block;"><i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}</span>@enderror
                        </div>

                        <button wire:click="updateProfile" wire:loading.attr="disabled" class="profil-btn profil-btn-primary">
                            <span wire:loading.remove wire:target="updateProfile"><i class="bi bi-check2-circle"></i>Sauvegarder</span>
                            <span wire:loading wire:target="updateProfile"><i class="bi bi-hourglass-split"></i>Enregistrement...</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- ── Changer le mot de passe ── --}}
            <div class="col-lg-6">
                <div class="profil-card h-100">
                    <div class="profil-card-header">
                        <div class="profil-card-icon" style="background:rgba(24,29,56,.08);">
                            <i class="bi bi-lock-fill" style="color:#181d38;"></i>
                        </div>
                        <div>
                            <h6 style="font-family:'Nunito',sans-serif;font-weight:800;color:var(--cfp-text,#0f172a);margin:0;font-size:.95rem;">Mot de passe</h6>
                            <p style="color:var(--cfp-muted,#64748b);font-size:.78rem;margin:2px 0 0;">Minimum 8 caractères</p>
                        </div>
                    </div>

                    <div class="profil-divider"></div>
                    <div class="profil-card-body" style="padding-top:24px;">

                        @if($passwordSuccess)
                            <div class="profil-alert profil-alert-ok">
                                <i class="bi bi-shield-check"></i> {{ $passwordSuccess }}
                            </div>
                        @endif
                        @if($passwordError)
                            <div class="profil-alert profil-alert-err">
                                <i class="bi bi-exclamation-circle-fill"></i> {{ $passwordError }}
                            </div>
                        @endif

                        <div style="margin-bottom:16px;">
                            <label class="profil-label"><i class="bi bi-key me-1"></i>Mot de passe actuel</label>
                            <input wire:model="currentPassword" type="password" class="profil-input" placeholder="Mot de passe actuel">
                            @error('currentPassword')<span style="color:#ef4444;font-size:.78rem;margin-top:5px;display:block;">{{ $message }}</span>@enderror
                        </div>

                        <div style="margin-bottom:16px;">
                            <label class="profil-label"><i class="bi bi-lock me-1"></i>Nouveau mot de passe</label>
                            <input wire:model="newPassword" type="password" class="profil-input" placeholder="Minimum 8 caractères">
                            @error('newPassword')<span style="color:#ef4444;font-size:.78rem;margin-top:5px;display:block;">{{ $message }}</span>@enderror
                        </div>

                        <div style="margin-bottom:28px;">
                            <label class="profil-label"><i class="bi bi-shield-lock me-1"></i>Confirmer</label>
                            <input wire:model="newPasswordConfirmation" type="password" class="profil-input" placeholder="Répétez le nouveau mot de passe">
                        </div>

                        <button wire:click="updatePassword" wire:loading.attr="disabled" class="profil-btn profil-btn-dark">
                            <span wire:loading.remove wire:target="updatePassword"><i class="bi bi-shield-lock-fill"></i>Changer le mot de passe</span>
                            <span wire:loading wire:target="updatePassword"><i class="bi bi-hourglass-split"></i>Modification...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Barre de statut compte ── --}}
        <div class="profil-card mt-4">
            <div class="profil-stat-row">
                <div class="profil-stat-item">
                    <i class="bi bi-patch-check-fill" style="color:#06BBCC;font-size:1.05rem;"></i>
                    <span class="profil-stat-text">Compte vérifié</span>
                </div>
                <div class="profil-stat-sep"></div>
                <div class="profil-stat-item">
                    <i class="bi bi-person-circle" style="color:#181d38;font-size:1.05rem;"></i>
                    <span class="profil-stat-text">{{ auth()->user()->email }}</span>
                </div>
                <div class="profil-stat-sep"></div>
                <div class="profil-stat-item">
                    <i class="bi bi-calendar-check" style="color:#f59e0b;font-size:1.05rem;"></i>
                    <span class="profil-stat-text">Inscrit le {{ auth()->user()->created_at->locale('fr')->isoFormat('D MMMM YYYY') }}</span>
                </div>

                {{-- Retour au tableau de bord selon le rôle --}}
                <div style="margin-left:auto;">
                    @if($role === 'super admin')
                        <a href="{{ route('dashboard') }}" class="profil-btn profil-btn-primary" style="text-decoration:none;font-size:.82rem;padding:10px 20px;">
                            <i class="bi bi-grid-fill"></i> Tableau de bord
                        </a>
                    @elseif($role === 'formateur')
                        <a href="{{ route('dashboard') }}" class="profil-btn profil-btn-primary" style="text-decoration:none;font-size:.82rem;padding:10px 20px;">
                            <i class="bi bi-grid-fill"></i> Mon espace
                        </a>
                    @else
                        <a href="{{ route('acceuil') }}" class="profil-btn profil-btn-primary" style="text-decoration:none;font-size:.82rem;padding:10px 20px;">
                            <i class="bi bi-house-fill"></i> Accueil
                        </a>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>

</div>
