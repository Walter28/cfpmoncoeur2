<div>

{{-- ── Welcome Banner ── --}}
<div style="background:linear-gradient(135deg,#0f1628 0%,#1a2a4a 60%,#0e3d4a 100%);border-radius:20px;padding:32px 36px;margin-bottom:28px;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-40px;right:-40px;width:200px;height:200px;border-radius:50%;background:rgba(6,187,204,.07);pointer-events:none;"></div>
    <div style="position:absolute;bottom:-60px;right:100px;width:280px;height:280px;border-radius:50%;background:rgba(6,187,204,.04);pointer-events:none;"></div>
    <div class="row align-items-center g-3">
        <div class="col-lg-8">
            <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(6,187,204,.12);border:1px solid rgba(6,187,204,.2);border-radius:50px;padding:5px 14px;margin-bottom:14px;">
                <span style="width:7px;height:7px;border-radius:50%;background:#06BBCC;box-shadow:0 0 0 3px rgba(6,187,204,.3);display:inline-block;"></span>
                <span style="color:#06BBCC;font-size:.72rem;font-weight:800;letter-spacing:1.2px;text-transform:uppercase;">Espace actif</span>
            </div>
            <h2 style="color:#fff;font-family:'Nunito',sans-serif;font-weight:900;font-size:clamp(1.5rem,3vw,2rem);margin-bottom:8px;line-height:1.2;">
                Bienvenue, {{ explode(' ', Auth::user()->name ?? 'Étudiant')[0] }}
            </h2>
            <p style="color:rgba(255,255,255,.6);margin:0;font-size:.9rem;line-height:1.6;">
                @if($mesInscriptions && $mesInscriptions->count() > 0)
                    Vous suivez <strong style="color:#06BBCC;">{{ $mesInscriptions->count() }}</strong> formation(s).
                    Continuez votre progression aujourd'hui !
                @else
                    Vous n'avez pas encore de formation. Explorez nos programmes ci-dessous.
                @endif
            </p>
        </div>
        <div class="col-lg-4 text-lg-end">
            <a href="{{ route('nos-formations') }}" wire:navigate
               style="background:linear-gradient(135deg,#06BBCC,#059aaa);color:#fff;border-radius:12px;padding:12px 24px;font-family:'Nunito',sans-serif;font-weight:800;font-size:.9rem;text-decoration:none;display:inline-flex;align-items:center;gap:8px;transition:transform .15s;"
               onmouseover="this.style.transform='translateY(-2px)'"
               onmouseout="this.style.transform=''">
                <i class="bi bi-search"></i> Explorer les formations
            </a>
        </div>
    </div>
</div>

{{-- ── KPI Cards ── --}}
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:16px;margin-bottom:28px;">

    @php
        $total     = $mesInscriptions ? $mesInscriptions->count() : 0;
        $enCours   = $total; // All are "in progress" for now
        $terminees = 0;
    @endphp

    <div style="background:#fff;border-radius:16px;padding:22px 20px;border:1px solid #e8edf5;box-shadow:0 2px 12px rgba(0,0,0,.05);position:relative;overflow:hidden;">
        <div style="width:42px;height:42px;background:rgba(6,187,204,.1);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:14px;">
            <i class="bi bi-book-fill" style="color:#06BBCC;font-size:1.1rem;"></i>
        </div>
        <div style="font-size:2rem;font-weight:900;color:#0f172a;line-height:1;">{{ $total }}</div>
        <div style="font-size:.78rem;font-weight:700;color:#94a3b8;margin-top:4px;text-transform:uppercase;letter-spacing:.5px;">Inscriptions</div>
        <div style="position:absolute;bottom:-10px;right:-10px;width:60px;height:60px;border-radius:50%;background:rgba(6,187,204,.05);"></div>
    </div>

    <div style="background:#fff;border-radius:16px;padding:22px 20px;border:1px solid #e8edf5;box-shadow:0 2px 12px rgba(0,0,0,.05);position:relative;overflow:hidden;">
        <div style="width:42px;height:42px;background:rgba(79,70,229,.08);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:14px;">
            <i class="bi bi-play-circle-fill" style="color:#4f46e5;font-size:1.1rem;"></i>
        </div>
        <div style="font-size:2rem;font-weight:900;color:#0f172a;line-height:1;">{{ $enCours }}</div>
        <div style="font-size:.78rem;font-weight:700;color:#94a3b8;margin-top:4px;text-transform:uppercase;letter-spacing:.5px;">En cours</div>
        <div style="position:absolute;bottom:-10px;right:-10px;width:60px;height:60px;border-radius:50%;background:rgba(79,70,229,.05);"></div>
    </div>

    <div style="background:#fff;border-radius:16px;padding:22px 20px;border:1px solid #e8edf5;box-shadow:0 2px 12px rgba(0,0,0,.05);position:relative;overflow:hidden;">
        <div style="width:42px;height:42px;background:rgba(16,185,129,.08);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:14px;">
            <i class="bi bi-patch-check-fill" style="color:#10b981;font-size:1.1rem;"></i>
        </div>
        <div style="font-size:2rem;font-weight:900;color:#0f172a;line-height:1;">{{ $terminees }}</div>
        <div style="font-size:.78rem;font-weight:700;color:#94a3b8;margin-top:4px;text-transform:uppercase;letter-spacing:.5px;">Terminées</div>
        <div style="position:absolute;bottom:-10px;right:-10px;width:60px;height:60px;border-radius:50%;background:rgba(16,185,129,.05);"></div>
    </div>

    <div style="background:#fff;border-radius:16px;padding:22px 20px;border:1px solid #e8edf5;box-shadow:0 2px 12px rgba(0,0,0,.05);position:relative;overflow:hidden;">
        <div style="width:42px;height:42px;background:rgba(245,158,11,.08);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:14px;">
            <i class="bi bi-trophy-fill" style="color:#f59e0b;font-size:1.1rem;"></i>
        </div>
        <div style="font-size:2rem;font-weight:900;color:#0f172a;line-height:1;">0</div>
        <div style="font-size:.78rem;font-weight:700;color:#94a3b8;margin-top:4px;text-transform:uppercase;letter-spacing:.5px;">Certificats</div>
        <div style="position:absolute;bottom:-10px;right:-10px;width:60px;height:60px;border-radius:50%;background:rgba(245,158,11,.05);"></div>
    </div>

</div>

{{-- ── Main Grid ── --}}
<div style="display:grid;grid-template-columns:1fr 320px;gap:20px;align-items:start;" class="student-main-grid">

    {{-- ── Left: Mes formations ── --}}
    <div>

        {{-- Continuer l'apprentissage (dernière inscription) --}}
        @if($mesInscriptions && $mesInscriptions->count() > 0)
        @php $derniere = $mesInscriptions->first(); @endphp
        <div style="background:#fff;border-radius:20px;border:1px solid #e8edf5;box-shadow:0 2px 16px rgba(0,0,0,.06);margin-bottom:20px;overflow:hidden;">
            <div style="padding:20px 24px 16px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;">
                <div>
                    <h6 style="font-family:'Nunito',sans-serif;font-weight:800;color:#0f172a;margin:0 0 2px;font-size:.95rem;">
                        <i class="bi bi-lightning-charge-fill" style="color:#f59e0b;margin-right:6px;"></i>Reprendre où j'en étais
                    </h6>
                    <p style="color:#94a3b8;font-size:.75rem;margin:0;">Continuez votre dernière formation</p>
                </div>
            </div>
            <div style="padding:20px 24px;display:flex;gap:20px;align-items:center;flex-wrap:wrap;">
                <div style="width:80px;height:80px;border-radius:14px;overflow:hidden;flex-shrink:0;background:linear-gradient(135deg,#1e2a5e,#0e3d4a);">
                    @if($derniere->formation && $derniere->formation->photo && \Illuminate\Support\Facades\Storage::exists('public/'.$derniere->formation->photo))
                        <img src="{{ asset('storage/'.$derniere->formation->photo) }}" style="width:100%;height:100%;object-fit:cover;">
                    @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-book-fill" style="color:rgba(6,187,204,.5);font-size:1.8rem;"></i>
                        </div>
                    @endif
                </div>
                <div style="flex:1;min-width:0;">
                    <div style="font-family:'Nunito',sans-serif;font-weight:800;color:#0f172a;font-size:1rem;margin-bottom:4px;">
                        {{ $derniere->formation->titre ?? 'Formation' }}
                    </div>
                    @if($derniere->formation && $derniere->formation->formateur)
                    <div style="font-size:.78rem;color:#64748b;margin-bottom:10px;display:flex;align-items:center;gap:6px;">
                        <i class="bi bi-person-fill" style="color:#06BBCC;"></i>
                        {{ $derniere->formation->formateur->prenom }} {{ $derniere->formation->formateur->nom }}
                    </div>
                    @endif
                    <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
                        @if($derniere->formation && $derniere->formation->duree)
                        <span style="font-size:.75rem;color:#94a3b8;display:flex;align-items:center;gap:4px;">
                            <i class="bi bi-clock" style="color:#06BBCC;"></i> {{ $derniere->formation->duree }}
                        </span>
                        @endif
                        @if($derniere->formation && $derniere->formation->lieu)
                        <span style="font-size:.75rem;color:#94a3b8;display:flex;align-items:center;gap:4px;">
                            <i class="bi bi-geo-alt-fill" style="color:#06BBCC;"></i> {{ $derniere->formation->lieu }}
                        </span>
                        @endif
                        <span style="font-size:.72rem;background:rgba(16,185,129,.1);color:#059669;border-radius:20px;padding:3px 10px;font-weight:700;">
                            Inscrit le {{ $derniere->date_inscription ? \Carbon\Carbon::parse($derniere->date_inscription)->format('d/m/Y') : $derniere->created_at->format('d/m/Y') }}
                        </span>
                    </div>
                </div>
                @if($derniere->formation)
                <a href="{{ route('formation.detail', $derniere->formation->id) }}"
                   style="background:linear-gradient(135deg,#06BBCC,#059aaa);color:#fff;border-radius:10px;padding:10px 20px;font-family:'Nunito',sans-serif;font-weight:800;font-size:.82rem;text-decoration:none;white-space:nowrap;flex-shrink:0;display:flex;align-items:center;gap:6px;">
                    <i class="bi bi-play-fill"></i> Voir la formation
                </a>
                @endif
            </div>
        </div>
        @endif

        {{-- Toutes mes formations --}}
        <div style="background:#fff;border-radius:20px;border:1px solid #e8edf5;box-shadow:0 2px 16px rgba(0,0,0,.06);overflow:hidden;">
            <div style="padding:20px 24px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;">
                <div>
                    <h6 style="font-family:'Nunito',sans-serif;font-weight:800;color:#0f172a;margin:0 0 2px;font-size:.95rem;">
                        <i class="bi bi-collection-fill" style="color:#4f46e5;margin-right:6px;"></i>Toutes mes formations
                    </h6>
                    <p style="color:#94a3b8;font-size:.75rem;margin:0;">Formations auxquelles vous êtes inscrit</p>
                </div>
                <a href="{{ route('nos-formations') }}" wire:navigate
                   style="background:rgba(6,187,204,.08);color:#06BBCC;border-radius:8px;padding:6px 14px;font-size:.75rem;font-weight:800;text-decoration:none;white-space:nowrap;">
                    + Explorer
                </a>
            </div>

            @if(!$mesInscriptions || $mesInscriptions->isEmpty())
            <div style="padding:60px 24px;text-align:center;">
                <div style="width:72px;height:72px;background:#f1f5f9;border-radius:20px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <i class="bi bi-book" style="font-size:1.8rem;color:#94a3b8;"></i>
                </div>
                <h6 style="font-weight:800;color:#0f172a;margin-bottom:6px;">Aucune formation pour le moment</h6>
                <p style="color:#94a3b8;font-size:.85rem;margin-bottom:20px;">Explorez nos formations et inscrivez-vous dès aujourd'hui.</p>
                <a href="{{ route('nos-formations') }}" wire:navigate
                   style="background:linear-gradient(135deg,#06BBCC,#059aaa);color:#fff;border-radius:10px;padding:11px 24px;font-family:'Nunito',sans-serif;font-weight:800;font-size:.875rem;text-decoration:none;display:inline-flex;align-items:center;gap:8px;">
                    <i class="bi bi-search"></i> Voir les formations
                </a>
            </div>
            @else
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:0;">
                @foreach($mesInscriptions as $ins)
                @if($ins->formation)
                <div style="padding:20px 24px;border-bottom:1px solid #f8fafc;border-right:1px solid #f8fafc;transition:background .15s;" onmouseover="this.style.background='#fafbff'" onmouseout="this.style.background=''">
                    <div style="display:flex;gap:14px;align-items:flex-start;">
                        <div style="width:54px;height:54px;border-radius:12px;overflow:hidden;flex-shrink:0;background:linear-gradient(135deg,#1e2a5e,#0e3d4a);">
                            @if($ins->formation->photo && \Illuminate\Support\Facades\Storage::exists('public/'.$ins->formation->photo))
                                <img src="{{ asset('storage/'.$ins->formation->photo) }}" style="width:100%;height:100%;object-fit:cover;">
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                                    <i class="bi bi-book-fill" style="color:rgba(6,187,204,.5);font-size:1.1rem;"></i>
                                </div>
                            @endif
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div style="font-weight:800;color:#0f172a;font-size:.875rem;margin-bottom:3px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                                {{ $ins->formation->titre }}
                            </div>
                            @if($ins->formation->formateur)
                            <div style="font-size:.72rem;color:#64748b;margin-bottom:8px;display:flex;align-items:center;gap:4px;">
                                <i class="bi bi-person-circle" style="color:#06BBCC;"></i>
                                {{ $ins->formation->formateur->prenom }} {{ $ins->formation->formateur->nom }}
                            </div>
                            @endif
                            <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                                @if($ins->formation->prix && $ins->formation->prix > 0)
                                <span style="font-size:.7rem;background:rgba(79,70,229,.08);color:#4f46e5;border-radius:6px;padding:2px 8px;font-weight:700;">
                                    {{ number_format($ins->formation->prix,0,',',' ') }} FC
                                </span>
                                @else
                                <span style="font-size:.7rem;background:rgba(16,185,129,.08);color:#059669;border-radius:6px;padding:2px 8px;font-weight:700;">
                                    Gratuit
                                </span>
                                @endif
                                @if($ins->formation->duree)
                                <span style="font-size:.7rem;color:#94a3b8;display:flex;align-items:center;gap:3px;">
                                    <i class="bi bi-clock"></i> {{ $ins->formation->duree }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <a href="{{ route('formation.detail', $ins->formation->id) }}"
                           style="width:30px;height:30px;background:rgba(6,187,204,.1);color:#06BBCC;border-radius:8px;display:flex;align-items:center;justify-content:center;text-decoration:none;flex-shrink:0;transition:all .15s;"
                           onmouseover="this.style.background='#06BBCC';this.style.color='#fff'"
                           onmouseout="this.style.background='rgba(6,187,204,.1)';this.style.color='#06BBCC'"
                           title="Voir la formation">
                            <i class="bi bi-arrow-right" style="font-size:.8rem;"></i>
                        </a>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            @endif
        </div>

    </div>

    {{-- ── Right: Quick Actions + Profile ── --}}
    <div style="display:flex;flex-direction:column;gap:16px;">

        {{-- Profile card --}}
        @if($monProfil)
        <div style="background:#fff;border-radius:20px;border:1px solid #e8edf5;box-shadow:0 2px 16px rgba(0,0,0,.06);padding:24px;text-align:center;">
            <div style="width:64px;height:64px;border-radius:18px;background:linear-gradient(135deg,#06BBCC,#059aaa);display:flex;align-items:center;justify-content:center;margin:0 auto 12px;font-family:'Nunito',sans-serif;font-weight:900;color:#fff;font-size:1.3rem;">
                {{ strtoupper(substr($monProfil->prenom,0,1)) }}{{ strtoupper(substr($monProfil->nom,0,1)) }}
            </div>
            <div style="font-family:'Nunito',sans-serif;font-weight:800;color:#0f172a;font-size:1rem;margin-bottom:4px;">
                {{ $monProfil->prenom }} {{ $monProfil->nom }}
            </div>
            <div style="display:inline-flex;align-items:center;gap:5px;background:rgba(6,187,204,.08);color:#06BBCC;border-radius:20px;padding:4px 12px;font-size:.72rem;font-weight:800;margin-bottom:12px;">
                <i class="bi bi-mortarboard-fill"></i> Étudiant
            </div>
            @if($monProfil->email)
            <div style="font-size:.78rem;color:#94a3b8;display:flex;align-items:center;justify-content:center;gap:5px;">
                <i class="bi bi-envelope-fill" style="color:#06BBCC;"></i> {{ Str::limit($monProfil->email, 28) }}
            </div>
            @endif
            @if($monProfil->contact)
            <div style="font-size:.78rem;color:#94a3b8;display:flex;align-items:center;justify-content:center;gap:5px;margin-top:4px;">
                <i class="bi bi-telephone-fill" style="color:#06BBCC;"></i> {{ $monProfil->contact }}
            </div>
            @endif
            <a href="{{ route('profile.show') }}"
               style="display:block;margin-top:14px;background:#f4f7fb;color:#374151;border-radius:10px;padding:9px 16px;font-family:'Nunito',sans-serif;font-weight:800;font-size:.78rem;text-decoration:none;transition:background .15s;"
               onmouseover="this.style.background='#e8edf5'"
               onmouseout="this.style.background='#f4f7fb'">
                <i class="bi bi-pencil-fill me-2"></i>Modifier mon profil
            </a>
        </div>
        @else
        <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:16px;padding:18px;font-size:.82rem;color:#92400e;">
            <i class="bi bi-info-circle-fill me-2"></i>
            Votre dossier étudiant est en cours de création. Contactez l'administration.
        </div>
        @endif

        {{-- Quick actions --}}
        <div style="background:#fff;border-radius:20px;border:1px solid #e8edf5;box-shadow:0 2px 16px rgba(0,0,0,.06);padding:20px;">
            <h6 style="font-family:'Nunito',sans-serif;font-weight:800;color:#0f172a;margin-bottom:14px;font-size:.88rem;">
                <i class="bi bi-lightning-fill" style="color:#f59e0b;margin-right:6px;"></i>Actions rapides
            </h6>
            <div style="display:flex;flex-direction:column;gap:8px;">
                <a href="{{ route('nos-formations') }}" wire:navigate
                   style="display:flex;align-items:center;gap:10px;padding:11px 14px;background:#f4f7fb;border-radius:10px;text-decoration:none;color:#374151;font-size:.82rem;font-weight:700;transition:all .15s;"
                   onmouseover="this.style.background='rgba(6,187,204,.08)';this.style.color='#06BBCC'"
                   onmouseout="this.style.background='#f4f7fb';this.style.color='#374151'">
                    <div style="width:32px;height:32px;background:rgba(6,187,204,.1);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="bi bi-search" style="color:#06BBCC;font-size:.85rem;"></i>
                    </div>
                    Explorer les formations
                </a>
                <a href="{{ route('contact') }}"
                   style="display:flex;align-items:center;gap:10px;padding:11px 14px;background:#f4f7fb;border-radius:10px;text-decoration:none;color:#374151;font-size:.82rem;font-weight:700;transition:all .15s;"
                   onmouseover="this.style.background='rgba(79,70,229,.06)';this.style.color='#4f46e5'"
                   onmouseout="this.style.background='#f4f7fb';this.style.color='#374151'">
                    <div style="width:32px;height:32px;background:rgba(79,70,229,.08);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="bi bi-chat-dots-fill" style="color:#4f46e5;font-size:.85rem;"></i>
                    </div>
                    Contacter l'administration
                </a>
                <a href="{{ route('profile.show') }}"
                   style="display:flex;align-items:center;gap:10px;padding:11px 14px;background:#f4f7fb;border-radius:10px;text-decoration:none;color:#374151;font-size:.82rem;font-weight:700;transition:all .15s;"
                   onmouseover="this.style.background='rgba(16,185,129,.06)';this.style.color='#059669'"
                   onmouseout="this.style.background='#f4f7fb';this.style.color='#374151'">
                    <div style="width:32px;height:32px;background:rgba(16,185,129,.08);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="bi bi-person-fill" style="color:#059669;font-size:.85rem;"></i>
                    </div>
                    Mon profil
                </a>
            </div>
        </div>

        {{-- Info banner --}}
        <div style="background:linear-gradient(135deg,#0f1628,#1a2a4a);border-radius:16px;padding:20px;text-align:center;">
            <i class="bi bi-mortarboard-fill" style="font-size:1.8rem;color:#06BBCC;margin-bottom:10px;display:block;"></i>
            <div style="font-family:'Nunito',sans-serif;font-weight:800;color:#fff;font-size:.88rem;margin-bottom:6px;">Vous avez des questions ?</div>
            <p style="color:rgba(255,255,255,.55);font-size:.75rem;margin-bottom:14px;">Notre équipe est disponible pour vous aider.</p>
            <a href="{{ route('contact') }}"
               style="display:block;background:rgba(6,187,204,.15);border:1px solid rgba(6,187,204,.25);color:#06BBCC;border-radius:10px;padding:9px 16px;font-family:'Nunito',sans-serif;font-weight:800;font-size:.78rem;text-decoration:none;">
                <i class="bi bi-send-fill me-2"></i>Nous contacter
            </a>
        </div>

    </div>
</div>

<style>
@media (max-width: 900px) {
    .student-main-grid { grid-template-columns: 1fr !important; }
}
</style>

</div>
