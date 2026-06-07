<div>
<div class="dash-container">

    {{-- Welcome --}}
    <div style="background:linear-gradient(135deg,#0f1628 0%,#1a2a4a 60%,#0e3d4a 100%);border-radius:20px;padding:28px 32px;margin-bottom:28px;position:relative;overflow:hidden;">
        <div style="position:absolute;top:-40px;right:-40px;width:180px;height:180px;border-radius:50%;background:rgba(6,187,204,.06);pointer-events:none;"></div>
        <div class="row align-items-center g-3">
            <div class="col-md-8">
                <span style="display:inline-flex;align-items:center;gap:7px;background:rgba(6,187,204,.12);border:1px solid rgba(6,187,204,.2);border-radius:50px;padding:5px 14px;margin-bottom:12px;">
                    <span style="width:7px;height:7px;border-radius:50%;background:#06BBCC;box-shadow:0 0 0 3px rgba(6,187,204,.3);display:inline-block;"></span>
                    <span style="color:#06BBCC;font-size:.7rem;font-weight:800;letter-spacing:1.2px;text-transform:uppercase;">Formateur actif</span>
                </span>
                <h3 style="color:#fff;font-family:'Nunito',sans-serif;font-weight:900;font-size:clamp(1.4rem,3vw,1.9rem);margin-bottom:8px;">
                    Bonjour, {{ explode(' ', Auth::user()->name ?? 'Formateur')[0] }}
                </h3>
                <p style="color:rgba(255,255,255,.6);margin:0;font-size:.88rem;">
                    Vous avez <strong style="color:#06BBCC;">{{ $mesFormations ? $mesFormations->count() : 0 }}</strong> formation(s) et
                    <strong style="color:#06BBCC;">{{ $mesEtudiants ? $mesEtudiants->count() : 0 }}</strong> étudiant(s) inscrit(s).
                </p>
            </div>
            @if($monProfilFormateur)
            <div class="col-md-4 text-md-end">
                <div style="display:inline-flex;flex-direction:column;align-items:center;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:16px 20px;">
                    @if($monProfilFormateur->photo && \Illuminate\Support\Facades\Storage::exists('public/'.$monProfilFormateur->photo))
                        <img src="{{ asset('storage/'.$monProfilFormateur->photo) }}" style="width:52px;height:52px;border-radius:14px;object-fit:cover;margin-bottom:8px;border:2px solid rgba(6,187,204,.4);">
                    @else
                        <div style="width:52px;height:52px;border-radius:14px;background:linear-gradient(135deg,#06BBCC,#059aaa);display:flex;align-items:center;justify-content:center;margin-bottom:8px;font-family:'Nunito',sans-serif;font-weight:900;color:#fff;font-size:1rem;">
                            {{ strtoupper(substr($monProfilFormateur->prenom,0,1)) }}{{ strtoupper(substr($monProfilFormateur->nom,0,1)) }}
                        </div>
                    @endif
                    <div style="color:rgba(255,255,255,.9);font-weight:800;font-size:.85rem;">{{ $monProfilFormateur->prenom }} {{ $monProfilFormateur->nom }}</div>
                    <div style="color:#06BBCC;font-size:.7rem;font-weight:700;">{{ $monProfilFormateur->domaine }}</div>
                </div>
            </div>
            @endif
        </div>
    </div>

    @if(!$monProfilFormateur)
    <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:14px;padding:18px 20px;margin-bottom:24px;display:flex;align-items:center;gap:12px;">
        <i class="bi bi-exclamation-triangle-fill" style="color:#f59e0b;font-size:1.3rem;flex-shrink:0;"></i>
        <div>
            <strong style="color:#92400e;">Profil formateur non lié.</strong>
            <span style="color:#78350f;font-size:.85rem;"> Votre compte n'est pas encore associé à un profil formateur. Contactez l'administration.</span>
        </div>
    </div>
    @else

    {{-- KPI Cards --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;margin-bottom:24px;">

        <div class="dash-kpi-card dash-kpi-indigo">
            <div class="dash-kpi-icon"><i class="bx bxs-book-open"></i></div>
            <div class="dash-kpi-body">
                <span class="dash-kpi-label">Mes formations</span>
                <span class="dash-kpi-value">{{ $mesFormations->count() }}</span>
                <span class="dash-kpi-sub">Cours dispensés</span>
            </div>
            <div class="dash-kpi-wave"></div>
        </div>

        <div class="dash-kpi-card dash-kpi-orange">
            <div class="dash-kpi-icon"><i class="bx bxs-graduation"></i></div>
            <div class="dash-kpi-body">
                <span class="dash-kpi-label">Mes étudiants</span>
                <span class="dash-kpi-value">{{ $mesEtudiants->count() }}</span>
                <span class="dash-kpi-sub">Inscrits à vos cours</span>
            </div>
            <div class="dash-kpi-wave"></div>
        </div>

        <div class="dash-kpi-card dash-kpi-teal">
            <div class="dash-kpi-icon"><i class="bx bxs-user-voice"></i></div>
            <div class="dash-kpi-body">
                <span class="dash-kpi-label">Domaine</span>
                <span class="dash-kpi-value" style="font-size:.95rem;line-height:1.3;">{{ Str::limit($monProfilFormateur->domaine ?? '—', 14) }}</span>
                <span class="dash-kpi-sub">Spécialité</span>
            </div>
            <div class="dash-kpi-wave"></div>
        </div>

    </div>

    {{-- Main row: chart + actions --}}
    <div class="dash-main-row">

        <div class="dash-card dash-chart-card">
            <div class="dash-card-header">
                <div>
                    <h6 class="dash-card-title">Inscriptions à mes formations — 6 mois</h6>
                    <p class="dash-card-subtitle">Évolution mensuelle des inscriptions</p>
                </div>
                <span class="dash-badge-teal">Statistiques</span>
            </div>
            <div id="formateur-chart" style="min-height:260px;"></div>
        </div>

        <div class="dash-card">
            <div class="dash-card-header">
                <h6 class="dash-card-title">Actions rapides</h6>
            </div>
            <div style="display:flex;flex-direction:column;gap:8px;">
                <a href="{{ route('acceuil') }}" target="_blank"
                   style="display:flex;align-items:center;gap:10px;padding:11px 14px;background:#f4f7fb;border-radius:10px;text-decoration:none;color:#374151;font-size:.82rem;font-weight:700;transition:background .15s;"
                   onmouseover="this.style.background='rgba(6,187,204,.07)'" onmouseout="this.style.background='#f4f7fb'">
                    <div style="width:32px;height:32px;background:rgba(6,187,204,.1);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="bi bi-globe2" style="color:#06BBCC;font-size:.85rem;"></i>
                    </div>
                    Voir le site public
                </a>
                <a href="{{ route('contact') }}"
                   style="display:flex;align-items:center;gap:10px;padding:11px 14px;background:#f4f7fb;border-radius:10px;text-decoration:none;color:#374151;font-size:.82rem;font-weight:700;transition:background .15s;"
                   onmouseover="this.style.background='rgba(79,70,229,.06)'" onmouseout="this.style.background='#f4f7fb'">
                    <div style="width:32px;height:32px;background:rgba(79,70,229,.08);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="bi bi-chat-dots-fill" style="color:#4f46e5;font-size:.85rem;"></i>
                    </div>
                    Contacter l'administration
                </a>
                <a href="{{ route('profile.show') }}"
                   style="display:flex;align-items:center;gap:10px;padding:11px 14px;background:#f4f7fb;border-radius:10px;text-decoration:none;color:#374151;font-size:.82rem;font-weight:700;transition:background .15s;"
                   onmouseover="this.style.background='rgba(16,185,129,.06)'" onmouseout="this.style.background='#f4f7fb'">
                    <div style="width:32px;height:32px;background:rgba(16,185,129,.08);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="bi bi-person-fill" style="color:#059669;font-size:.85rem;"></i>
                    </div>
                    Mon profil
                </a>
            </div>
        </div>

    </div>

    {{-- Mes formations --}}
    @if($mesFormations->count() > 0)
    <div class="dash-card" style="margin-bottom:20px;">
        <div class="dash-card-header">
            <div>
                <h6 class="dash-card-title">Mes formations</h6>
                <p class="dash-card-subtitle">Formations que vous dispensez</p>
            </div>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:16px;">
            @foreach($mesFormations as $f)
            <div style="border:1px solid #e8edf5;border-radius:14px;overflow:hidden;background:#fafbff;transition:box-shadow .15s;"
                 onmouseover="this.style.boxShadow='0 4px 20px rgba(0,0,0,.08)'"
                 onmouseout="this.style.boxShadow=''">
                <div style="height:120px;background:linear-gradient(135deg,#1e2a5e,#0e3d4a);overflow:hidden;">
                    @if($f->photo && \Illuminate\Support\Facades\Storage::exists('public/'.$f->photo))
                        <img src="{{ asset('storage/'.$f->photo) }}" style="width:100%;height:100%;object-fit:cover;">
                    @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-book-fill" style="color:rgba(6,187,204,.4);font-size:2rem;"></i>
                        </div>
                    @endif
                </div>
                <div style="padding:14px 16px;">
                    <div style="font-weight:800;color:#0f172a;font-size:.875rem;margin-bottom:6px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $f->titre }}</div>
                    <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin-bottom:10px;">
                        @if($f->duree)
                        <span style="font-size:.7rem;color:#64748b;display:flex;align-items:center;gap:3px;">
                            <i class="bi bi-clock" style="color:#06BBCC;"></i> {{ $f->duree }}
                        </span>
                        @endif
                        @if($f->lieu)
                        <span style="font-size:.7rem;color:#64748b;display:flex;align-items:center;gap:3px;">
                            <i class="bi bi-geo-alt" style="color:#06BBCC;"></i> {{ $f->lieu }}
                        </span>
                        @endif
                    </div>
                    <div style="display:flex;align-items:center;justify-content:space-between;">
                        @if(!$f->prix || $f->prix == 0)
                            <span style="font-size:.72rem;background:rgba(16,185,129,.1);color:#059669;border-radius:6px;padding:3px 8px;font-weight:800;">Gratuit</span>
                        @else
                            <span style="font-size:.82rem;font-weight:800;color:#0f172a;">{{ number_format($f->prix,0,',',' ') }} FC</span>
                        @endif
                        <a href="{{ route('formation.detail', $f->id) }}"
                           style="font-size:.75rem;color:#06BBCC;font-weight:700;text-decoration:none;display:flex;align-items:center;gap:4px;">
                            Voir <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="dash-card" style="margin-bottom:20px;">
        <div class="dash-empty-state">
            <i class="bx bx-book-open"></i>
            <p>Aucune formation ne vous est encore assignée.<br>Contactez l'administration.</p>
        </div>
    </div>
    @endif

    {{-- Mes étudiants récents --}}
    @if($mesEtudiants->count() > 0)
    <div class="dash-card">
        <div class="dash-card-header">
            <div>
                <h6 class="dash-card-title">Inscriptions récentes à mes cours</h6>
                <p class="dash-card-subtitle">Les derniers étudiants inscrits</p>
            </div>
            <span class="dash-badge-teal">{{ $mesEtudiants->count() }} inscrit(s)</span>
        </div>
        <div class="dash-table-wrap">
            <table class="dash-table">
                <thead>
                    <tr><th>#</th><th>Étudiant</th><th>Formation</th><th>Date</th><th>Statut</th></tr>
                </thead>
                <tbody>
                    @foreach($mesEtudiants as $i => $ins)
                    <tr>
                        <td><span class="dash-row-num">{{ $i+1 }}</span></td>
                        <td>
                            <div class="dash-user-cell">
                                <div class="dash-avatar">{{ strtoupper(substr($ins->etudiant->nom ?? 'E',0,1)) }}</div>
                                <div>
                                    <div class="dash-user-name">{{ $ins->etudiant->prenom ?? '' }} {{ $ins->etudiant->nom ?? '—' }}</div>
                                    <div class="dash-user-sub">{{ $ins->etudiant->email ?? '' }}</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="dash-formation-tag">{{ Str::limit($ins->formation->titre ?? '—', 30) }}</span></td>
                        <td class="dash-date-cell"><i class="bx bx-calendar me-1"></i>{{ $ins->created_at->format('d/m/Y') }}</td>
                        <td><span class="dash-status-badge">Confirmée</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    @endif {{-- end if monProfilFormateur --}}

</div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var chartEl = document.querySelector('#formateur-chart');
    if (!chartEl) return;
    var monthlyData = @json($monthlyData ?? []);
    new ApexCharts(chartEl, {
        series: [{ name: 'Inscriptions', data: monthlyData.map(d => d.count) }],
        chart: { type: 'area', height: 260, toolbar: { show: false }, fontFamily: 'Nunito, sans-serif' },
        colors: ['#06BBCC'],
        fill: { type: 'gradient', gradient: { shadeIntensity:1, opacityFrom:.4, opacityTo:.05 } },
        stroke: { curve: 'smooth', width: 3 },
        xaxis: { categories: monthlyData.map(d => d.label), axisBorder:{show:false}, axisTicks:{show:false}, labels:{style:{colors:'#9ca3af',fontSize:'12px'}} },
        yaxis: { labels:{style:{colors:'#9ca3af',fontSize:'12px'}}, min:0, tickAmount:4, forceNiceScale:true },
        grid: { borderColor:'#f3f4f6', strokeDashArray:4 },
        dataLabels: { enabled:false },
        markers: { size:5, colors:['#06BBCC'], strokeColors:'#fff', strokeWidth:2 },
        tooltip: { theme:'light', y:{formatter: v => v+' inscription(s)'} }
    }).render();
});
</script>
@endpush
