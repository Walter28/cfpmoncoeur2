<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'Mon Espace' }} — CFP Mon Cœur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('assets_backend/images/favicon.png?v=1') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@boxicons/css/boxicons.min.css" rel="stylesheet">

    @livewireStyles

    <style>
    *, *::before, *::after { box-sizing: border-box; }

    :root {
        --teal:      #06BBCC;
        --teal-dark: #059aaa;
        --dark:      #0f172a;
        --sidebar-bg:#1a1f3d;
        --muted:     #94a3b8;
        --border:    #e8edf5;
        --bg:        #f4f7fb;
        --white:     #ffffff;
        --sidebar-w: 256px;
        --header-h:  64px;
    }

    /* ═══ DARK MODE ═══ */
    [data-theme="dark"] { --bg:#0f172a; --white:#1e293b; --border:rgba(255,255,255,.07); --dark:#f1f5f9; --muted:#64748b; }
    [data-theme="dark"] body { background:#0f172a!important; }
    [data-theme="dark"] .f-header { background:#1e293b!important; border-color:rgba(255,255,255,.06)!important; box-shadow:0 1px 12px rgba(0,0,0,.35)!important; }
    [data-theme="dark"] .f-header-title { color:#f1f5f9!important; }
    [data-theme="dark"] .f-header-date { color:#64748b!important; }
    [data-theme="dark"] .f-icon-btn { background:rgba(255,255,255,.04)!important; border-color:rgba(255,255,255,.07)!important; color:#94a3b8!important; }
    [data-theme="dark"] .f-icon-btn:hover { background:rgba(6,187,204,.15)!important; color:#06BBCC!important; border-color:rgba(6,187,204,.3)!important; }
    [data-theme="dark"] .f-profile-btn { background:rgba(255,255,255,.04)!important; border-color:rgba(255,255,255,.07)!important; }
    [data-theme="dark"] .f-profile-name { color:#f1f5f9!important; }
    [data-theme="dark"] .f-dropdown { background:#1e293b!important; border-color:rgba(255,255,255,.08)!important; box-shadow:0 8px 32px rgba(0,0,0,.5)!important; }
    [data-theme="dark"] .f-dropdown a { color:#cbd5e1!important; }
    [data-theme="dark"] .f-dropdown a:hover { background:rgba(255,255,255,.05)!important; }
    [data-theme="dark"] .card,[data-theme="dark"] .dash-card,[data-theme="dark"] .bg-white { background:#1e293b!important; border-color:rgba(255,255,255,.07)!important; }
    [data-theme="dark"] .table { color:#cbd5e1!important; }
    [data-theme="dark"] thead th { background:rgba(255,255,255,.04)!important; color:#94a3b8!important; border-color:rgba(255,255,255,.06)!important; }
    [data-theme="dark"] td { border-color:rgba(255,255,255,.06)!important; }
    [data-theme="dark"] .form-control,[data-theme="dark"] .form-select,[data-theme="dark"] input:not([type=checkbox]):not([type=radio]),[data-theme="dark"] textarea { background:rgba(255,255,255,.05)!important; border-color:rgba(255,255,255,.1)!important; color:#f1f5f9!important; }
    [data-theme="dark"] .modal-content { background:#1e293b!important; border-color:rgba(255,255,255,.08)!important; }
    [data-theme="dark"] .modal-header,[data-theme="dark"] .modal-footer { border-color:rgba(255,255,255,.08)!important; }
    [data-theme="dark"] h1,[data-theme="dark"] h2,[data-theme="dark"] h3,[data-theme="dark"] h4,[data-theme="dark"] h5,[data-theme="dark"] h6 { color:#f1f5f9!important; }
    [data-theme="dark"] .text-muted { color:#64748b!important; }
    .dm-toggle-be { width:38px;height:38px;border-radius:10px;background:var(--bg);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:#64748b;cursor:pointer;flex-shrink:0;transition:all .18s; }
    .dm-toggle-be:hover { background:rgba(6,187,204,.1);color:#06BBCC;border-color:rgba(6,187,204,.3); }

    /* ═══ BORDS CARRÉS — SQUARE DESIGN ═══ */
    .card,.modal-content,.f-dropdown,.dash-card { border-radius:0!important; }
    .btn,.badge { border-radius:2px!important; }
    .form-control,.form-select,input:not([type=checkbox]):not([type=radio]),textarea,select { border-radius:0!important; }
    .f-brand-icon { border-radius:4px!important; }
    .f-nav-item,.f-icon-btn,.dm-toggle-be,.f-profile-btn { border-radius:4px!important; }
    .f-trainer-avatar { border-radius:4px!important; }
    .f-profile-avatar { border-radius:4px!important; }
    /* Fast transitions */
    .f-nav-item,.f-icon-btn,.dm-toggle-be,.btn,.form-control,.card,.f-profile-btn { transition-duration:.1s!important; }

    html, body { height: 100%; margin: 0; font-family: 'Nunito', sans-serif; background: var(--bg); color: var(--dark); }

    /* ═══ SIDEBAR ═══ */
    .f-sidebar {
        position: fixed; top: 0; left: 0;
        width: var(--sidebar-w); height: 100vh;
        background: var(--sidebar-bg);
        display: flex; flex-direction: column;
        z-index: 1000; overflow: hidden;
        transition: transform .3s;
        box-shadow: 4px 0 24px rgba(0,0,0,.2);
    }

    .f-brand {
        height: var(--header-h); padding: 0 20px;
        display: flex; align-items: center; gap: 10px;
        border-bottom: 1px solid rgba(255,255,255,.07);
        flex-shrink: 0;
    }
    .f-brand-icon {
        width: 36px; height: 36px;
        background: linear-gradient(135deg, var(--teal), var(--teal-dark));
        border-radius: 10px; display: flex; align-items: center; justify-content: center;
        box-shadow: 0 4px 12px rgba(6,187,204,.3); flex-shrink: 0;
    }
    .f-brand-icon i { color: #fff; font-size: 15px; }
    .f-brand-text { font-weight: 800; font-size: .95rem; color: #fff; letter-spacing: -.02em; }
    .f-brand-sub  { font-size: .67rem; color: var(--teal); font-weight: 700; }

    .f-trainer-card {
        margin: 12px; padding: 14px 16px;
        background: rgba(255,255,255,.06);
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 12px; flex-shrink: 0;
        display: flex; align-items: center; gap: 10px;
    }
    .f-trainer-avatar {
        width: 38px; height: 38px; border-radius: 10px;
        background: linear-gradient(135deg, var(--teal), var(--teal-dark));
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-weight: 800; font-size: .82rem; flex-shrink: 0;
    }
    .f-trainer-name { font-weight: 800; font-size: .84rem; color: rgba(255,255,255,.9); line-height: 1.2; }
    .f-trainer-role { font-size: .67rem; color: var(--teal); font-weight: 700; }

    .f-nav { flex: 1; overflow-y: auto; padding: 8px 10px; }
    .f-nav::-webkit-scrollbar { width: 3px; }
    .f-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,.1); border-radius: 3px; }

    .f-nav-label { font-size: .62rem; font-weight: 800; color: rgba(255,255,255,.3); letter-spacing: 1.5px; text-transform: uppercase; padding: 14px 10px 6px; }

    .f-nav-item {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 12px; border-radius: 10px;
        color: rgba(255,255,255,.6); font-size: .86rem; font-weight: 700;
        text-decoration: none; transition: all .18s; margin-bottom: 2px;
        cursor: pointer;
    }
    .f-nav-item i { font-size: 1.05rem; width: 20px; text-align: center; flex-shrink: 0; }
    .f-nav-item:hover  { background: rgba(6,187,204,.12); color: var(--teal); text-decoration: none; }
    .f-nav-item.active { background: rgba(6,187,204,.15); color: var(--teal); }

    .f-sidebar-footer {
        padding: 12px 10px;
        border-top: 1px solid rgba(255,255,255,.07);
        flex-shrink: 0;
    }

    /* ═══ MAIN ═══ */
    .f-main { margin-left: var(--sidebar-w); min-height: 100vh; display: flex; flex-direction: column; }

    .f-header {
        height: var(--header-h); background: var(--white);
        border-bottom: 1px solid var(--border);
        padding: 0 24px; display: flex; align-items: center; gap: 16px;
        position: sticky; top: 0; z-index: 900;
        box-shadow: 0 1px 12px rgba(0,0,0,.04);
    }
    .f-header-title { font-weight: 800; font-size: 1rem; color: var(--dark); margin: 0; flex: 1; }
    .f-header-date  { font-size: .75rem; color: var(--muted); font-weight: 600; white-space: nowrap; }

    .f-icon-btn {
        width: 38px; height: 38px; border-radius: 10px;
        background: var(--bg); border: 1px solid var(--border);
        display: flex; align-items: center; justify-content: center;
        color: #64748b; cursor: pointer; text-decoration: none;
        transition: all .18s; flex-shrink: 0;
    }
    .f-icon-btn:hover { background: rgba(6,187,204,.08); color: var(--teal); border-color: rgba(6,187,204,.3); }
    .f-icon-btn i { font-size: 1rem; }

    .f-profile-btn {
        display: flex; align-items: center; gap: 8px;
        padding: 4px 10px 4px 4px; background: var(--bg);
        border: 1px solid var(--border); border-radius: 10px;
        cursor: pointer; transition: all .18s; position: relative;
    }
    .f-profile-btn:hover { border-color: rgba(6,187,204,.4); background: rgba(6,187,204,.05); }
    .f-profile-avatar {
        width: 30px; height: 30px; border-radius: 8px;
        background: linear-gradient(135deg, var(--teal), var(--teal-dark));
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-weight: 800; font-size: .7rem; flex-shrink: 0;
    }
    .f-profile-name { font-size: .78rem; font-weight: 800; color: var(--dark); white-space: nowrap; }

    .f-dropdown {
        position: absolute; top: calc(100% + 8px); right: 0;
        background: #fff; border: 1px solid var(--border); border-radius: 12px;
        padding: 6px; min-width: 180px;
        box-shadow: 0 8px 32px rgba(0,0,0,.12); z-index: 9999; display: none;
    }
    .f-dropdown.show { display: block; }
    .f-dropdown a {
        display: flex; align-items: center; gap: 8px;
        padding: 8px 12px; border-radius: 8px;
        color: #374151; font-size: .82rem; font-weight: 700;
        text-decoration: none; transition: background .15s;
    }
    .f-dropdown a:hover { background: var(--bg); }
    .f-dropdown a.danger { color: #f43f5e; }
    .f-dd-divider { height: 1px; background: var(--border); margin: 4px 0; }

    .f-content { flex: 1; padding: 28px 24px; }

    /* Overlay + hamburger */
    .f-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.5); z-index: 999; }
    .f-hamburger {
        display: none; width: 38px; height: 38px; border-radius: 10px;
        background: var(--bg); border: 1px solid var(--border);
        align-items: center; justify-content: center; cursor: pointer; flex-shrink: 0;
    }
    .f-hamburger i { font-size: 1.1rem; color: var(--dark); }

    @media (max-width: 768px) {
        .f-sidebar { transform: translateX(-100%); }
        .f-sidebar.open { transform: translateX(0); }
        .f-overlay.show { display: block; }
        .f-main { margin-left: 0; }
        .f-hamburger { display: flex; }
        .f-content { padding: 16px; }
    }

    /* ═══ Shared component styles ═══ */
    :root {
        --cfp-teal:   #06BBCC;
        --cfp-indigo: #4f46e5;
        --cfp-orange: #f59e0b;
        --cfp-rose:   #f43f5e;
        --cfp-green:  #10b981;
    }
    .dash-container { max-width: 1400px; }
    .dash-page-header { display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; margin-bottom:28px; }
    .dash-page-title  { font-size:1.4rem; font-weight:800; color:var(--dark); margin:0; }
    .dash-page-subtitle{ color:#9ca3af; font-size:.875rem; margin:2px 0 0; }
    .dash-date-badge  { display:inline-flex; align-items:center; background:#fff; border:1px solid #e5e7eb; border-radius:10px; padding:8px 16px; font-size:.8rem; color:#6b7280; font-weight:600; }
    .dash-kpi-grid    { display:grid; grid-template-columns:repeat(auto-fill,minmax(200px,1fr)); gap:18px; margin-bottom:24px; }
    .dash-kpi-card    { position:relative; border-radius:16px; padding:22px 20px; overflow:hidden; color:#fff; box-shadow:0 4px 20px rgba(0,0,0,.12); transition:transform .2s,box-shadow .2s; }
    .dash-kpi-card:hover { transform:translateY(-3px); box-shadow:0 8px 32px rgba(0,0,0,.16); }
    .dash-kpi-teal    { background:linear-gradient(135deg,#06BBCC,#059aaa); }
    .dash-kpi-indigo  { background:linear-gradient(135deg,#4f46e5,#3730a3); }
    .dash-kpi-orange  { background:linear-gradient(135deg,#f59e0b,#d97706); }
    .dash-kpi-rose    { background:linear-gradient(135deg,#f43f5e,#be123c); }
    .dash-kpi-green   { background:linear-gradient(135deg,#10b981,#059669); }
    .dash-kpi-icon    { font-size:2rem; opacity:.25; margin-bottom:12px; display:block; }
    .dash-kpi-label   { display:block; font-size:.75rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; opacity:.85; }
    .dash-kpi-value   { display:block; font-size:2.4rem; font-weight:800; line-height:1.1; margin:4px 0; }
    .dash-kpi-sub     { display:block; font-size:.72rem; opacity:.75; }
    .dash-kpi-wave    { position:absolute; bottom:-20px; right:-20px; width:100px; height:100px; border-radius:50%; background:rgba(255,255,255,.08); }
    .dash-main-row    { display:grid; grid-template-columns:1fr 300px; gap:18px; margin-bottom:24px; }
    @media(max-width:900px){ .dash-main-row{grid-template-columns:1fr;} }
    .dash-card        { background:#fff; border-radius:16px; padding:24px; box-shadow:0 1px 8px rgba(0,0,0,.06); border:1px solid #f1f5f9; }
    .dash-card-header { display:flex; align-items:flex-start; justify-content:space-between; gap:12px; margin-bottom:20px; }
    .dash-card-title  { font-size:.95rem; font-weight:800; color:var(--dark); margin:0; }
    .dash-card-subtitle{ font-size:.78rem; color:#9ca3af; margin:2px 0 0; }
    .dash-badge-teal  { display:inline-block; background:rgba(6,187,204,.1); color:var(--cfp-teal); border-radius:8px; padding:4px 12px; font-size:.72rem; font-weight:700; }
    .dash-table-wrap  { overflow-x:auto; border-radius:12px; }
    .dash-table       { width:100%; border-collapse:separate; border-spacing:0; font-size:.85rem; }
    .dash-table thead th { background:#f8fafc; color:#6b7280; font-size:.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; padding:12px 16px; border-bottom:1px solid #e5e7eb; white-space:nowrap; }
    .dash-table tbody tr { transition:background .15s; }
    .dash-table tbody tr:hover { background:#f8fafc; }
    .dash-table tbody td { padding:13px 16px; border-bottom:1px solid #f1f5f9; vertical-align:middle; color:#374151; }
    .dash-table tbody tr:last-child td { border-bottom:none; }
    .dash-row-num     { display:inline-flex; align-items:center; justify-content:center; width:26px; height:26px; border-radius:8px; background:#f1f5f9; font-size:.75rem; font-weight:700; color:#9ca3af; }
    .dash-user-cell   { display:flex; align-items:center; gap:10px; }
    .dash-avatar      { width:34px; height:34px; border-radius:10px; flex-shrink:0; background:linear-gradient(135deg,#06BBCC,#059aaa); color:#fff; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:.8rem; }
    .dash-user-name   { font-weight:700; font-size:.85rem; color:var(--dark); line-height:1.2; }
    .dash-user-sub    { font-size:.72rem; color:#9ca3af; }
    .dash-formation-tag{ display:inline-block; background:rgba(79,70,229,.1); color:#4f46e5; border-radius:8px; padding:3px 10px; font-size:.75rem; font-weight:700; }
    .dash-date-cell   { color:#6b7280; white-space:nowrap; }
    .dash-status-badge{ display:inline-flex; align-items:center; gap:4px; background:rgba(16,185,129,.1); color:#10b981; border-radius:8px; padding:4px 10px; font-size:.72rem; font-weight:700; }
    .dash-status-badge::before { content:''; width:6px; height:6px; border-radius:50%; background:#10b981; }
    .dash-empty-state { text-align:center; padding:48px 20px; color:#9ca3af; }
    .dash-empty-state i { font-size:3rem; margin-bottom:12px; display:block; opacity:.4; }
    .dash-chart-card  { min-width:0; }
    </style>
    <script>
    (function(){ var s=localStorage.getItem('cfp-theme'); if(s==='dark') document.documentElement.setAttribute('data-theme','dark'); })();
    </script>
</head>
<body>

<div class="f-overlay" id="fOverlay" onclick="closeFSidebar()"></div>

<!-- ═══ SIDEBAR ═══ -->
<aside class="f-sidebar" id="fSidebar">

    <div class="f-brand">
        <div class="f-brand-icon"><i class="fa fa-graduation-cap"></i></div>
        <div>
            <div class="f-brand-text">CFP Mon Cœur</div>
            <div class="f-brand-sub">Espace Formateur</div>
        </div>
    </div>

    <div class="f-trainer-card">
        <div class="f-trainer-avatar">
            {{ strtoupper(substr(Auth::user()->name ?? 'F', 0, 2)) }}
        </div>
        <div>
            <div class="f-trainer-name">{{ explode(' ', Auth::user()->name ?? '')[0] }}</div>
            <div class="f-trainer-role">Formateur</div>
        </div>
    </div>

    <nav class="f-nav">
        <div class="f-nav-label">Mon espace</div>

        <a href="{{ route('dashboard') }}" class="f-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Tableau de bord
        </a>
        <a href="{{ route('acceuil') }}" class="f-nav-item" target="_blank">
            <i class="bi bi-globe2"></i> Voir le site
        </a>
        <a href="{{ route('contact') }}" class="f-nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
            <i class="bi bi-envelope-fill"></i> Contacter l'admin
        </a>

        <div class="f-nav-label">Compte</div>
        <a href="{{ route('mon.profil') }}" class="f-nav-item {{ request()->routeIs('mon.profil') ? 'active' : '' }}">
            <i class="bi bi-person-fill"></i> Mon profil
        </a>
    </nav>

    <div class="f-sidebar-footer">
        <form method="POST" action="{{ route('logout') }}"
              onsubmit="return confirm('Voulez-vous vraiment vous déconnecter ?')">
            @csrf
            <button type="submit" class="f-nav-item w-100 border-0 bg-transparent" style="text-align:left;">
                <i class="bi bi-box-arrow-left" style="color:#f43f5e;"></i>
                <span style="color:#f43f5e;">Déconnexion</span>
            </button>
        </form>
    </div>

</aside>

<!-- ═══ MAIN ═══ -->
<div class="f-main">

    <header class="f-header">
        <div class="f-hamburger" id="fHamburger" onclick="openFSidebar()">
            <i class="bi bi-list"></i>
        </div>

        <p class="f-header-title d-none d-md-block">
            Bonjour {{ explode(' ', Auth::user()->name ?? '')[0] }} 👋
        </p>

        <span class="f-header-date d-none d-lg-block">
            {{ now()->locale('fr')->isoFormat('dddd D MMMM YYYY') }}
        </span>

        <!-- Dark mode toggle -->
        <button type="button" class="dm-toggle-be" onclick="cfpToggleDark()" title="Mode sombre / clair">
            <i class="bi bi-moon-fill dm-icon"></i>
        </button>

        <a href="{{ route('acceuil') }}" class="f-icon-btn" target="_blank" title="Voir le site">
            <i class="bi bi-globe2"></i>
        </a>

        <div style="position:relative;">
            <div class="f-profile-btn" onclick="toggleFProfile()" id="fProfileBtn">
                <div class="f-profile-avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'F', 0, 2)) }}
                </div>
                <span class="f-profile-name d-none d-md-block">
                    {{ Str::limit(Auth::user()->name ?? '', 18) }}
                </span>
                <i class="bi bi-chevron-down" style="font-size:.7rem;color:#94a3b8;margin-left:4px;"></i>
            </div>
            <div class="f-dropdown" id="fProfileMenu">
                <a href="{{ route('profile.show') }}"><i class="bi bi-person-fill" style="color:#06BBCC;"></i> Mon profil</a>
                <div class="f-dd-divider"></div>
                <a href="#" class="danger"
                   onclick="event.preventDefault(); document.getElementById('fLogout').submit();">
                    <i class="bi bi-box-arrow-left"></i> Déconnexion
                </a>
                <form id="fLogout" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            </div>
        </div>
    </header>

    <main class="f-content">
        {{ $slot }}
    </main>

    <footer style="padding:14px 24px;border-top:1px solid var(--border);background:#fff;font-size:.75rem;color:#94a3b8;display:flex;justify-content:space-between;align-items:center;">
        <span>&copy; {{ date('Y') }} CFP Mon Cœur — Goma, RDC</span>
        <span>Développé par Christiane Mwenge</span>
    </footer>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.49.2/dist/apexcharts.min.js"></script>
<script>
function openFSidebar()  { document.getElementById('fSidebar').classList.add('open'); document.getElementById('fOverlay').classList.add('show'); }
function closeFSidebar() { document.getElementById('fSidebar').classList.remove('open'); document.getElementById('fOverlay').classList.remove('show'); }
function toggleFProfile() { document.getElementById('fProfileMenu').classList.toggle('show'); }
document.addEventListener('click', function(e) {
    var btn = document.getElementById('fProfileBtn'), menu = document.getElementById('fProfileMenu');
    if (btn && menu && !btn.contains(e.target) && !menu.contains(e.target)) menu.classList.remove('show');
});
</script>
<script>
function cfpToggleDark() {
    var html = document.documentElement;
    var isDark = html.getAttribute('data-theme') === 'dark';
    html.setAttribute('data-theme', isDark ? 'light' : 'dark');
    localStorage.setItem('cfp-theme', isDark ? 'light' : 'dark');
    document.querySelectorAll('.dm-icon').forEach(function(el){
        el.className = isDark ? 'bi bi-moon-fill dm-icon' : 'bi bi-sun-fill dm-icon';
    });
}
document.addEventListener('DOMContentLoaded', function(){
    var isDark = document.documentElement.getAttribute('data-theme') === 'dark';
    document.querySelectorAll('.dm-icon').forEach(function(el){
        el.className = isDark ? 'bi bi-sun-fill dm-icon' : 'bi bi-moon-fill dm-icon';
    });
});
</script>
@livewireScripts
@stack('scripts')
</body>
</html>
