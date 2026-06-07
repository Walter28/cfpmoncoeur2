<div>
<div class="dash-container">

    <!-- ── Page Header ── -->
    <div class="dash-page-header">
        <div>
            <h4 class="dash-page-title">Tableau de bord</h4>
            <p class="dash-page-subtitle">Bienvenue, <strong>{{ Auth::user()->name }}</strong> — Vue d'ensemble du système</p>
        </div>
        <div class="dash-date-badge">
            <i class="bi bi-calendar3 me-2"></i>
            {{ now()->locale('fr')->isoFormat('dddd D MMMM YYYY') }}
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="dash-kpi-grid">
        <div class="dash-kpi-card dash-kpi-teal">
            <span class="dash-kpi-icon"><i class="bi bi-person-badge-fill"></i></span>
            <div class="dash-kpi-body">
                <span class="dash-kpi-label">Formateurs</span>
                <span class="dash-kpi-value">{{ $totalFormateurs }}</span>
                <span class="dash-kpi-sub">Experts actifs</span>
            </div>
            <div class="dash-kpi-wave"></div>
        </div>
        <div class="dash-kpi-card dash-kpi-indigo">
            <span class="dash-kpi-icon"><i class="bi bi-book-fill"></i></span>
            <div class="dash-kpi-body">
                <span class="dash-kpi-label">Formations</span>
                <span class="dash-kpi-value">{{ $totalFormations }}</span>
                <span class="dash-kpi-sub">Programmes disponibles</span>
            </div>
            <div class="dash-kpi-wave"></div>
        </div>
        <div class="dash-kpi-card dash-kpi-orange">
            <span class="dash-kpi-icon"><i class="bi bi-mortarboard-fill"></i></span>
            <div class="dash-kpi-body">
                <span class="dash-kpi-label">Étudiants</span>
                <span class="dash-kpi-value">{{ $totalEtudiants }}</span>
                <span class="dash-kpi-sub">Apprenants inscrits</span>
            </div>
            <div class="dash-kpi-wave"></div>
        </div>
        <div class="dash-kpi-card dash-kpi-rose">
            <span class="dash-kpi-icon"><i class="bi bi-pen-fill"></i></span>
            <div class="dash-kpi-body">
                <span class="dash-kpi-label">Inscriptions</span>
                <span class="dash-kpi-value">{{ $totalInscriptions }}</span>
                <span class="dash-kpi-sub">Total enregistrées</span>
            </div>
            <div class="dash-kpi-wave"></div>
        </div>
        <div class="dash-kpi-card dash-kpi-green">
            <span class="dash-kpi-icon"><i class="bi bi-heart-fill"></i></span>
            <div class="dash-kpi-body">
                <span class="dash-kpi-label">Dons reçus</span>
                <span class="dash-kpi-value">{{ $totalDons }}</span>
                <span class="dash-kpi-sub">Contributions</span>
            </div>
            <div class="dash-kpi-wave"></div>
        </div>
        <div class="dash-kpi-card dash-kpi-purple">
            <span class="dash-kpi-icon"><i class="bi bi-envelope-fill"></i></span>
            <div class="dash-kpi-body">
                <span class="dash-kpi-label">Messages non lus</span>
                <span class="dash-kpi-value">{{ $totalMessages }}</span>
                <span class="dash-kpi-sub">Contacts en attente</span>
            </div>
            <div class="dash-kpi-wave"></div>
        </div>
    </div>

    <!-- Alerte formateurs en attente -->
    @if($pendingFormateurs > 0)
    <div style="background:linear-gradient(135deg,#fffbeb,#fef3c7);border:1px solid #fde68a;border-radius:16px;padding:18px 24px;margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
        <div style="display:flex;align-items:center;gap:12px;">
            <div style="width:40px;height:40px;background:rgba(245,158,11,.15);border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <i class="bi bi-exclamation-triangle-fill" style="color:#f59e0b;font-size:1.1rem;"></i>
            </div>
            <div>
                <div style="font-weight:800;color:#92400e;font-size:.9rem;">
                    {{ $pendingFormateurs }} formateur(s) en attente d'approbation
                </div>
                <p style="color:#78350f;font-size:.78rem;margin:2px 0 0;">
                    Ces formateurs ne peuvent pas encore accéder à leur espace jusqu'à votre approbation.
                </p>
            </div>
        </div>
        <a href="{{ route('formateur') }}"
           style="background:#f59e0b;color:#fff;border-radius:10px;padding:9px 18px;font-weight:800;font-size:.82rem;text-decoration:none;display:inline-flex;align-items:center;gap:6px;white-space:nowrap;">
            <i class="bi bi-check-circle-fill"></i> Approuver maintenant
        </a>
    </div>
    @endif

    <!-- Chart + Quick Actions -->
    <div class="dash-main-row">
        <div class="dash-card dash-chart-card" style="margin-bottom:0;">
            <div class="dash-card-header">
                <div>
                    <h6 class="dash-card-title">Inscriptions — 6 derniers mois</h6>
                    <p class="dash-card-subtitle">Évolution mensuelle des inscriptions</p>
                </div>
                <span class="dash-badge-teal">Statistiques</span>
            </div>
            <div id="inscriptions-chart" style="min-height:260px;"></div>
        </div>
        <div class="dash-card" style="margin-bottom:0;">
            <div class="dash-card-header">
                <div>
                    <h6 class="dash-card-title">Actions rapides</h6>
                    <p class="dash-card-subtitle">Accès direct aux modules</p>
                </div>
            </div>
            <div class="dash-actions-grid">
                <a href="{{ route('formateur') }}" class="dash-action-btn dash-action-teal">
                    <i class="bi bi-person-badge-fill"></i><span>Formateurs</span>
                </a>
                <a href="{{ route('etudiant') }}" class="dash-action-btn dash-action-indigo">
                    <i class="bi bi-mortarboard-fill"></i><span>Étudiants</span>
                </a>
                <a href="{{ route('formation') }}" class="dash-action-btn dash-action-orange">
                    <i class="bi bi-book-fill"></i><span>Formations</span>
                </a>
                <a href="{{ route('inscription') }}" class="dash-action-btn dash-action-rose">
                    <i class="bi bi-pen-fill"></i><span>Inscriptions</span>
                </a>
                <a href="{{ route('dons') }}" class="dash-action-btn dash-action-green">
                    <i class="bi bi-heart-fill"></i><span>Dons</span>
                </a>
                <a href="{{ route('messages') }}" class="dash-action-btn dash-action-purple">
                    <i class="bi bi-envelope-fill"></i><span>Messages</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Inscriptions -->
    <div class="dash-card" style="margin-top:20px;">
        <div class="dash-card-header">
            <div>
                <h6 class="dash-card-title">Inscriptions récentes</h6>
                <p class="dash-card-subtitle">Les 8 dernières inscriptions enregistrées</p>
            </div>
            <a href="{{ route('inscription') }}" class="dash-badge-teal" style="text-decoration:none;">Voir tout</a>
        </div>
        <div class="dash-table-wrap">
            @if($recentInscriptions->isEmpty())
                <div class="dash-empty-state">
                    <i class="bi bi-pen"></i>
                    <p>Aucune inscription pour le moment</p>
                </div>
            @else
            <table class="dash-table">
                <thead>
                    <tr><th>#</th><th>Étudiant</th><th>Formation</th><th>Date</th><th>Statut</th></tr>
                </thead>
                <tbody>
                    @foreach($recentInscriptions as $i => $ins)
                    <tr>
                        <td><span class="dash-row-num">{{ $i + 1 }}</span></td>
                        <td>
                            <div class="dash-user-cell">
                                <div class="dash-avatar">{{ strtoupper(substr($ins->etudiant->nom ?? 'E', 0, 1)) }}</div>
                                <div>
                                    <div class="dash-user-name">{{ $ins->etudiant->prenom ?? '' }} {{ $ins->etudiant->nom ?? '—' }}</div>
                                    <div class="dash-user-sub">{{ $ins->etudiant->email ?? '' }}</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="dash-formation-tag">{{ $ins->formation->titre ?? '—' }}</span></td>
                        <td class="dash-date-cell">
                            <i class="bi bi-calendar-check me-1"></i>
                            {{ $ins->date_inscription ? \Carbon\Carbon::parse($ins->date_inscription)->format('d/m/Y') : $ins->created_at->format('d/m/Y') }}
                        </td>
                        <td><span class="dash-status-badge">Confirmée</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>

</div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var chartEl = document.querySelector('#inscriptions-chart');
    if (!chartEl) return;
    var monthlyData = @json($monthlyData ?? []);
    new ApexCharts(chartEl, {
        series: [{ name: 'Inscriptions', data: monthlyData.map(d => d.count) }],
        chart: { type: 'area', height: 260, toolbar: { show: false }, fontFamily: 'Nunito, sans-serif' },
        colors: ['#06BBCC'],
        fill: { type: 'gradient', gradient: { shadeIntensity:1, opacityFrom:.4, opacityTo:.05, stops:[0,90,100] } },
        stroke: { curve: 'smooth', width: 3 },
        xaxis: { categories: monthlyData.map(d => d.label), axisBorder:{show:false}, axisTicks:{show:false},
            labels:{style:{colors:'#9ca3af',fontSize:'12px'}} },
        yaxis: { labels:{style:{colors:'#9ca3af',fontSize:'12px'}}, min:0, tickAmount:4, forceNiceScale:true },
        grid: { borderColor:'#f3f4f6', strokeDashArray:4 },
        dataLabels: { enabled:false },
        markers: { size:5, colors:['#06BBCC'], strokeColors:'#fff', strokeWidth:2 },
        tooltip: { theme:'light', y:{ formatter: v => v+' inscription(s)' } }
    }).render();
});
</script>
@endpush
