<div>

<!-- ── Hero ── -->
<div style="background:linear-gradient(135deg,#181d38 0%,#0f1628 100%);padding:80px 0 60px;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-60px;right:-60px;width:300px;height:300px;border-radius:50%;background:rgba(6,187,204,.06);"></div>
    <div class="container" style="position:relative;z-index:1;">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <a href="{{ route('nos-formations') }}" style="color:rgba(255,255,255,.5);font-size:.8rem;text-decoration:none;display:inline-flex;align-items:center;gap:6px;margin-bottom:16px;">
                    <i class="fa fa-arrow-left"></i> Retour aux formations
                </a>
                @if($formation->formateur)
                <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(6,187,204,.15);border-radius:50px;padding:5px 14px;margin-bottom:16px;">
                    <i class="fa fa-user-tie" style="color:#06BBCC;font-size:.75rem;"></i>
                    <span style="color:#06BBCC;font-size:.78rem;font-weight:700;">{{ $formation->formateur->prenom }} {{ $formation->formateur->nom }}</span>
                </div>
                @endif
                <h1 style="color:#fff;font-family:'Nunito',sans-serif;font-weight:800;font-size:clamp(1.8rem,4vw,2.6rem);line-height:1.2;margin-bottom:16px;">{{ $formation->titre }}</h1>
                <p style="color:rgba(255,255,255,.7);font-size:.95rem;line-height:1.75;margin-bottom:24px;">{{ Str::limit($formation->description, 200) }}</p>
                <div style="display:flex;flex-wrap:wrap;gap:16px;margin-bottom:24px;">
                    @if($formation->duree)
                    <div style="display:flex;align-items:center;gap:8px;color:rgba(255,255,255,.75);font-size:.85rem;">
                        <i class="fa fa-clock" style="color:#06BBCC;"></i> {{ $formation->duree }}
                    </div>
                    @endif
                    @if($formation->lieu)
                    <div style="display:flex;align-items:center;gap:8px;color:rgba(255,255,255,.75);font-size:.85rem;">
                        <i class="fa fa-map-marker-alt" style="color:#06BBCC;"></i> {{ $formation->lieu }}
                    </div>
                    @endif
                    @if($formation->session)
                    <div style="display:flex;align-items:center;gap:8px;color:rgba(255,255,255,.75);font-size:.85rem;">
                        <i class="fa fa-calendar" style="color:#06BBCC;"></i> {{ $formation->session }}
                    </div>
                    @endif
                </div>
                <!-- Price + CTA -->
                <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap;">
                    <div style="background:rgba(6,187,204,.15);border:1px solid rgba(6,187,204,.3);border-radius:12px;padding:10px 20px;">
                        @if(!$formation->prix || $formation->prix == 0)
                            <span style="color:#06BBCC;font-family:'Nunito',sans-serif;font-weight:800;font-size:1.4rem;">Gratuit</span>
                        @else
                            <span style="color:#06BBCC;font-family:'Nunito',sans-serif;font-weight:800;font-size:1.4rem;">{{ number_format($formation->prix, 0, ',', ' ') }} FC</span>
                        @endif
                    </div>
                    @if($inscriptionSuccess)
                        <div style="background:rgba(16,185,129,.15);border:1px solid rgba(16,185,129,.3);border-radius:12px;padding:12px 20px;color:#10b981;font-weight:700;font-size:.9rem;">
                            <i class="fa fa-check-circle me-2"></i>Inscription confirmée !
                        </div>
                    @elseif($dejaInscrit)
                        <div style="background:rgba(79,70,229,.15);border:1px solid rgba(79,70,229,.3);border-radius:12px;padding:12px 20px;color:#a5b4fc;font-weight:700;font-size:.9rem;">
                            <i class="fa fa-check me-2"></i>Vous êtes déjà inscrit
                        </div>
                    @else
                        <button wire:click="sInscrire"
                            style="background:linear-gradient(135deg,#06BBCC,#059aaa);color:#fff;border:none;border-radius:12px;padding:14px 28px;font-family:'Nunito',sans-serif;font-weight:700;font-size:.95rem;cursor:pointer;display:flex;align-items:center;gap:8px;">
                            <span wire:loading.remove wire:target="sInscrire"><i class="fa fa-graduation-cap me-1"></i>S'inscrire maintenant</span>
                            <span wire:loading wire:target="sInscrire"><i class="fa fa-spinner fa-spin me-1"></i>En cours...</span>
                        </button>
                    @endif
                </div>
                @if($inscriptionError)
                <div style="margin-top:12px;background:rgba(244,63,94,.15);border:1px solid rgba(244,63,94,.3);border-radius:10px;padding:10px 16px;color:#fda4af;font-size:.85rem;">
                    <i class="fa fa-exclamation-circle me-2"></i>{{ $inscriptionError }}
                    @if(!auth()->check())
                        <a href="{{ route('login') }}" style="color:#06BBCC;font-weight:700;margin-left:8px;">Se connecter</a>
                    @endif
                </div>
                @endif
            </div>
            <div class="col-lg-5">
                <div style="border-radius:20px;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,.3);">
                    @if($formation->photo && \Illuminate\Support\Facades\Storage::exists('public/'.$formation->photo))
                        <img src="{{ asset('storage/'.$formation->photo) }}" alt="{{ $formation->titre }}" style="width:100%;height:300px;object-fit:cover;">
                    @else
                        <div style="width:100%;height:300px;background:linear-gradient(135deg,#1e2a5e,#06BBCC22);display:flex;align-items:center;justify-content:center;">
                            <i class="fa fa-graduation-cap" style="color:rgba(6,187,204,.4);font-size:5rem;"></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ── Details ── -->
<div class="py-5" style="background:#f8fafc;">
<div class="container">
<div class="row g-4">

    <!-- Main Content -->
    <div class="col-lg-8">

        <!-- Description -->
        <div style="background:#fff;border-radius:16px;padding:32px;box-shadow:0 2px 12px rgba(0,0,0,.06);border:1px solid #f1f5f9;margin-bottom:20px;">
            <h5 style="font-family:'Nunito',sans-serif;font-weight:800;color:#181d38;margin-bottom:16px;display:flex;align-items:center;gap:10px;">
                <span style="width:32px;height:32px;background:rgba(6,187,204,.1);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                    <i class="fa fa-info-circle" style="color:#06BBCC;font-size:.9rem;"></i>
                </span>Description complète
            </h5>
            <p style="color:#6b7280;line-height:1.8;margin:0;white-space:pre-line;">{{ $formation->description }}</p>
        </div>

        <!-- Objectifs -->
        @if($formation->objectif)
        <div style="background:#fff;border-radius:16px;padding:32px;box-shadow:0 2px 12px rgba(0,0,0,.06);border:1px solid #f1f5f9;margin-bottom:20px;">
            <h5 style="font-family:'Nunito',sans-serif;font-weight:800;color:#181d38;margin-bottom:16px;display:flex;align-items:center;gap:10px;">
                <span style="width:32px;height:32px;background:rgba(79,70,229,.1);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                    <i class="fa fa-bullseye" style="color:#4f46e5;font-size:.9rem;"></i>
                </span>Objectifs de la formation
            </h5>
            <p style="color:#6b7280;line-height:1.8;margin:0;white-space:pre-line;">{{ $formation->objectif }}</p>
        </div>
        @endif

        <!-- Prérequis -->
        @if($formation->prerequis)
        <div style="background:#fff;border-radius:16px;padding:32px;box-shadow:0 2px 12px rgba(0,0,0,.06);border:1px solid #f1f5f9;margin-bottom:20px;">
            <h5 style="font-family:'Nunito',sans-serif;font-weight:800;color:#181d38;margin-bottom:16px;display:flex;align-items:center;gap:10px;">
                <span style="width:32px;height:32px;background:rgba(245,158,11,.1);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                    <i class="fa fa-list-check" style="color:#f59e0b;font-size:.9rem;"></i>
                </span>Prérequis
            </h5>
            <p style="color:#6b7280;line-height:1.8;margin:0;white-space:pre-line;">{{ $formation->prerequis }}</p>
        </div>
        @endif

        <!-- Vidéo -->
        @if($formation->video)
        <div style="background:#fff;border-radius:16px;padding:32px;box-shadow:0 2px 12px rgba(0,0,0,.06);border:1px solid #f1f5f9;margin-bottom:20px;">
            <h5 style="font-family:'Nunito',sans-serif;font-weight:800;color:#181d38;margin-bottom:16px;display:flex;align-items:center;gap:10px;">
                <span style="width:32px;height:32px;background:rgba(244,63,94,.1);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                    <i class="fa fa-play-circle" style="color:#f43f5e;font-size:.9rem;"></i>
                </span>Vidéo de présentation
            </h5>
            <div style="position:relative;padding-bottom:56.25%;border-radius:12px;overflow:hidden;">
                <iframe src="{{ $formation->video }}" style="position:absolute;inset:0;width:100%;height:100%;border:none;" allowfullscreen></iframe>
            </div>
        </div>
        @endif

    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">

        <!-- Quick Info -->
        <div style="background:#fff;border-radius:16px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,.06);border:1px solid #f1f5f9;margin-bottom:20px;">
            <h6 style="font-family:'Nunito',sans-serif;font-weight:800;color:#181d38;margin-bottom:16px;font-size:.9rem;text-transform:uppercase;letter-spacing:1px;">Infos rapides</h6>
            <div style="display:flex;flex-direction:column;gap:12px;">
                @php $infos = [
                    ['icon'=>'fa-tag','color'=>'#06BBCC','bg'=>'rgba(6,187,204,.1)','label'=>'Prix',
                     'value'=> (!$formation->prix || $formation->prix==0) ? 'Gratuit' : number_format($formation->prix,0,',',' ').' FC'],
                    ['icon'=>'fa-clock','color'=>'#4f46e5','bg'=>'rgba(79,70,229,.1)','label'=>'Durée','value'=>$formation->duree ?? 'Non précisé'],
                    ['icon'=>'fa-map-marker-alt','color'=>'#f59e0b','bg'=>'rgba(245,158,11,.1)','label'=>'Lieu','value'=>$formation->lieu ?? 'Non précisé'],
                    ['icon'=>'fa-layer-group','color'=>'#10b981','bg'=>'rgba(16,185,129,.1)','label'=>'Session','value'=>$formation->session ?? 'Non précisé'],
                ]; @endphp
                @foreach($infos as $info)
                <div style="display:flex;align-items:center;gap:12px;">
                    <div style="width:36px;height:36px;background:{{ $info['bg'] }};border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="fa {{ $info['icon'] }}" style="color:{{ $info['color'] }};font-size:.8rem;"></i>
                    </div>
                    <div>
                        <div style="font-size:.7rem;color:#9ca3af;font-weight:600;text-transform:uppercase;letter-spacing:.5px;">{{ $info['label'] }}</div>
                        <div style="font-size:.875rem;color:#374151;font-weight:700;">{{ $info['value'] }}</div>
                    </div>
                </div>
                @endforeach
                @if($formation->date_debut && $formation->date_fin)
                <div style="display:flex;align-items:center;gap:12px;">
                    <div style="width:36px;height:36px;background:rgba(244,63,94,.1);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="fa fa-calendar" style="color:#f43f5e;font-size:.8rem;"></i>
                    </div>
                    <div>
                        <div style="font-size:.7rem;color:#9ca3af;font-weight:600;text-transform:uppercase;letter-spacing:.5px;">Période</div>
                        <div style="font-size:.8rem;color:#374151;font-weight:700;">
                            {{ \Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y') }} →
                            {{ \Carbon\Carbon::parse($formation->date_fin)->format('d/m/Y') }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Formateur Card -->
        @if($formation->formateur)
        <div style="background:#fff;border-radius:16px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,.06);border:1px solid #f1f5f9;margin-bottom:20px;">
            <h6 style="font-family:'Nunito',sans-serif;font-weight:800;color:#181d38;margin-bottom:16px;font-size:.9rem;text-transform:uppercase;letter-spacing:1px;">Votre formateur</h6>
            <div style="display:flex;align-items:center;gap:12px;margin-bottom:12px;">
                @if($formation->formateur->photo && \Illuminate\Support\Facades\Storage::exists('public/'.$formation->formateur->photo))
                    <img src="{{ asset('storage/'.$formation->formateur->photo) }}" style="width:52px;height:52px;border-radius:12px;object-fit:cover;">
                @else
                    <div style="width:52px;height:52px;background:linear-gradient(135deg,#06BBCC,#059aaa);border-radius:12px;display:flex;align-items:center;justify-content:center;font-family:'Nunito',sans-serif;font-weight:800;color:#fff;font-size:1.1rem;flex-shrink:0;">
                        {{ strtoupper(substr($formation->formateur->prenom,0,1)) }}{{ strtoupper(substr($formation->formateur->nom,0,1)) }}
                    </div>
                @endif
                <div>
                    <div style="font-family:'Nunito',sans-serif;font-weight:800;color:#181d38;font-size:.95rem;">{{ $formation->formateur->prenom }} {{ $formation->formateur->nom }}</div>
                    <div style="color:#06BBCC;font-size:.78rem;font-weight:700;">{{ $formation->formateur->domaine }}</div>
                </div>
            </div>
            @if($formation->formateur->email)
            <a href="mailto:{{ $formation->formateur->email }}" style="display:flex;align-items:center;gap:8px;color:#6b7280;font-size:.8rem;text-decoration:none;">
                <i class="fa fa-envelope" style="color:#06BBCC;"></i>{{ $formation->formateur->email }}
            </a>
            @endif
        </div>
        @endif

        <!-- CTA sticky -->
        <div style="background:linear-gradient(135deg,#181d38,#0f1628);border-radius:16px;padding:24px;box-shadow:0 4px 24px rgba(0,0,0,.2);">
            <p style="color:rgba(255,255,255,.7);font-size:.85rem;margin-bottom:16px;text-align:center;">Rejoignez cette formation dès aujourd'hui</p>
            @if($inscriptionSuccess || $dejaInscrit)
                <div style="text-align:center;color:#10b981;font-weight:700;font-size:.9rem;padding:12px;background:rgba(16,185,129,.1);border-radius:10px;">
                    <i class="fa fa-check-circle me-2"></i>Inscrit ✓
                </div>
            @else
                <button wire:click="sInscrire" style="width:100%;background:linear-gradient(135deg,#06BBCC,#059aaa);color:#fff;border:none;border-radius:12px;padding:14px;font-family:'Nunito',sans-serif;font-weight:700;font-size:.95rem;cursor:pointer;">
                    <span wire:loading.remove wire:target="sInscrire"><i class="fa fa-graduation-cap me-2"></i>S'inscrire maintenant</span>
                    <span wire:loading wire:target="sInscrire"><i class="fa fa-spinner fa-spin me-2"></i>En cours...</span>
                </button>
            @endif
            <a href="{{ route('contact') }}" style="display:block;text-align:center;color:rgba(255,255,255,.5);font-size:.8rem;margin-top:12px;text-decoration:none;">
                <i class="fa fa-question-circle me-1"></i>Une question ? Contactez-nous
            </a>
        </div>

    </div>
</div>
</div>
</div>
</div>
