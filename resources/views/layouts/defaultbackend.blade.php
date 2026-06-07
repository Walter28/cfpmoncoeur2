<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'Administration' }} — CFP Mon Cœur</title>
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
        --teal-bg:   rgba(6,187,204,.1);
        --dark:      #0f172a;
        --sidebar-bg:#1a1f3d;
        --muted:     #94a3b8;
        --border:    #e8edf5;
        --bg:        #f4f7fb;
        --white:     #ffffff;
        --sidebar-w: 260px;
        --header-h:  64px;

        /* Shared semantic colours */
        --cfp-teal:   #06BBCC;
        --cfp-indigo: #4f46e5;
        --cfp-orange: #f59e0b;
        --cfp-rose:   #f43f5e;
        --cfp-green:  #10b981;
        --cfp-purple: #7c3aed;
        --cfp-dark:   #0f172a;
    }

    /* ═══ DARK MODE ═══ */
    [data-theme="dark"] { --bg:#0f172a; --white:#1e293b; --border:rgba(255,255,255,.07); --dark:#f1f5f9; --muted:#64748b; }
    [data-theme="dark"] body { background:#0f172a!important; }
    [data-theme="dark"] .a-header { background:#1e293b!important; border-color:rgba(255,255,255,.06)!important; box-shadow:0 1px 12px rgba(0,0,0,.35)!important; }
    [data-theme="dark"] .a-header-title { color:#f1f5f9!important; }
    [data-theme="dark"] .a-header-date { color:#64748b!important; }
    [data-theme="dark"] .a-icon-btn { background:rgba(255,255,255,.04)!important; border-color:rgba(255,255,255,.07)!important; color:#94a3b8!important; }
    [data-theme="dark"] .a-icon-btn:hover { background:rgba(6,187,204,.15)!important; color:#06BBCC!important; border-color:rgba(6,187,204,.3)!important; }
    [data-theme="dark"] .a-profile-btn { background:rgba(255,255,255,.04)!important; border-color:rgba(255,255,255,.07)!important; }
    [data-theme="dark"] .a-profile-name { color:#f1f5f9!important; }
    [data-theme="dark"] .a-dropdown { background:#1e293b!important; border-color:rgba(255,255,255,.08)!important; box-shadow:0 8px 32px rgba(0,0,0,.5)!important; }
    [data-theme="dark"] .a-dropdown a { color:#cbd5e1!important; }
    [data-theme="dark"] .a-dropdown a:hover { background:rgba(255,255,255,.05)!important; }
    [data-theme="dark"] .card,[data-theme="dark"] .bg-white { background:#1e293b!important; border-color:rgba(255,255,255,.07)!important; }
    [data-theme="dark"] .table { color:#cbd5e1!important; }
    [data-theme="dark"] thead th { background:rgba(255,255,255,.04)!important; color:#94a3b8!important; border-color:rgba(255,255,255,.06)!important; }
    [data-theme="dark"] td { border-color:rgba(255,255,255,.06)!important; }
    [data-theme="dark"] .form-control,[data-theme="dark"] .form-select,[data-theme="dark"] input:not([type=checkbox]):not([type=radio]),[data-theme="dark"] textarea { background:rgba(255,255,255,.05)!important; border-color:rgba(255,255,255,.1)!important; color:#f1f5f9!important; }
    [data-theme="dark"] .modal-content { background:#1e293b!important; border-color:rgba(255,255,255,.08)!important; }
    [data-theme="dark"] .modal-header,[data-theme="dark"] .modal-footer { border-color:rgba(255,255,255,.08)!important; }
    [data-theme="dark"] h1,[data-theme="dark"] h2,[data-theme="dark"] h3,[data-theme="dark"] h4,[data-theme="dark"] h5,[data-theme="dark"] h6 { color:#f1f5f9!important; }
    [data-theme="dark"] .text-muted { color:#64748b!important; }
    [data-theme="dark"] .badge.bg-light { background:#334155!important; color:#cbd5e1!important; }
    .dm-toggle-be { width:38px;height:38px;border-radius:10px;background:var(--bg);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:#64748b;cursor:pointer;flex-shrink:0;transition:all .18s; }
    .dm-toggle-be:hover { background:rgba(6,187,204,.1);color:#06BBCC;border-color:rgba(6,187,204,.3); }

    /* ═══ BORDS CARRÉS — SQUARE DESIGN GLOBAL ═══ */
    *, *::before, *::after { border-radius:0!important; }
    /* Fast transitions */
    .a-nav-item,.a-icon-btn,.dm-toggle-be,.btn,.form-control,.card,.a-profile-btn { transition-duration:.1s!important; }

    html, body { height:100%; margin:0; font-family:'Nunito',sans-serif; background:var(--bg); color:var(--dark); }

    /* ═══════════════ SIDEBAR ═══════════════ */
    .a-sidebar {
        position:fixed; top:0; left:0;
        width:var(--sidebar-w); height:100vh;
        background:var(--sidebar-bg);
        display:flex; flex-direction:column;
        z-index:1000; overflow:hidden;
        transition:transform .3s ease;
        box-shadow:4px 0 24px rgba(0,0,0,.25);
    }

    /* Brand */
    .a-brand {
        height:var(--header-h); padding:0 20px;
        display:flex; align-items:center; gap:10px;
        border-bottom:1px solid rgba(255,255,255,.07);
        flex-shrink:0;
    }
    .a-brand-icon {
        width:36px; height:36px;
        background:linear-gradient(135deg,var(--teal),var(--teal-dark));
        border-radius:10px; display:flex; align-items:center; justify-content:center;
        box-shadow:0 4px 14px rgba(6,187,204,.35); flex-shrink:0;
    }
    .a-brand-icon i { color:#fff; font-size:15px; }
    .a-brand-name { font-weight:900; font-size:.95rem; color:#fff; letter-spacing:-.02em; }
    .a-brand-sub  { font-size:.65rem; color:var(--teal); font-weight:800; letter-spacing:.5px; text-transform:uppercase; }

    /* Admin card */
    .a-admin-card {
        margin:12px; padding:13px 16px;
        background:rgba(255,255,255,.05);
        border:1px solid rgba(255,255,255,.08);
        border-radius:12px; flex-shrink:0;
        display:flex; align-items:center; gap:10px;
    }
    .a-admin-avatar {
        width:36px; height:36px; border-radius:10px;
        background:linear-gradient(135deg,var(--teal),var(--teal-dark));
        display:flex; align-items:center; justify-content:center;
        color:#fff; font-weight:900; font-size:.8rem; flex-shrink:0;
    }
    .a-admin-name  { font-weight:800; font-size:.83rem; color:rgba(255,255,255,.9); line-height:1.2; }
    .a-admin-badge {
        display:inline-flex; align-items:center; gap:4px;
        background:rgba(6,187,204,.15); color:var(--teal);
        border-radius:6px; padding:2px 8px; font-size:.62rem; font-weight:800; margin-top:3px;
    }

    /* Nav */
    .a-nav { flex:1; overflow-y:auto; padding:8px 10px; }
    .a-nav::-webkit-scrollbar { width:3px; }
    .a-nav::-webkit-scrollbar-thumb { background:rgba(255,255,255,.08); border-radius:3px; }

    .a-nav-section {
        font-size:.6rem; font-weight:900; color:rgba(255,255,255,.25);
        letter-spacing:1.8px; text-transform:uppercase;
        padding:14px 10px 5px;
    }

    .a-nav-item {
        display:flex; align-items:center; gap:10px;
        padding:9px 12px; border-radius:10px;
        color:rgba(255,255,255,.55); font-size:.85rem; font-weight:700;
        text-decoration:none; transition:all .18s; margin-bottom:2px;
        cursor:pointer; position:relative;
    }
    .a-nav-item i, .a-nav-item svg { font-size:1.05rem; width:20px; text-align:center; flex-shrink:0; }
    .a-nav-item:hover  { background:rgba(6,187,204,.1); color:var(--teal); text-decoration:none; }
    .a-nav-item.active { background:rgba(6,187,204,.15); color:var(--teal); }
    .a-nav-item .a-badge {
        margin-left:auto; background:var(--cfp-rose); color:#fff;
        border-radius:20px; padding:2px 7px; font-size:.62rem; font-weight:900;
        min-width:20px; text-align:center; flex-shrink:0;
    }
    .a-nav-item .a-badge-teal { background:var(--teal); }
    .a-nav-item .a-badge-purple { background:var(--cfp-purple); }

    /* Footer */
    .a-sidebar-footer {
        padding:10px 10px 16px;
        border-top:1px solid rgba(255,255,255,.07);
        flex-shrink:0;
    }
    .a-logout-btn {
        display:flex; align-items:center; gap:10px;
        padding:9px 12px; border-radius:10px;
        color:rgba(255,255,255,.4); font-size:.85rem; font-weight:700;
        width:100%; background:none; border:none; text-align:left;
        cursor:pointer; transition:all .18s;
    }
    .a-logout-btn:hover { background:rgba(244,63,94,.1); color:#f43f5e; }
    .a-logout-btn i { font-size:1.05rem; width:20px; text-align:center; flex-shrink:0; }

    /* ═══════════════ MAIN ═══════════════ */
    .a-main { margin-left:var(--sidebar-w); min-height:100vh; display:flex; flex-direction:column; }

    /* ═══════════════ HEADER ═══════════════ */
    .a-header {
        height:var(--header-h); background:var(--white);
        border-bottom:1px solid var(--border);
        padding:0 24px; display:flex; align-items:center; gap:14px;
        position:sticky; top:0; z-index:900;
        box-shadow:0 1px 12px rgba(0,0,0,.04);
    }
    .a-header-title { font-weight:800; font-size:1rem; color:var(--dark); margin:0; flex:1; }
    .a-header-date  { font-size:.75rem; color:var(--muted); font-weight:600; white-space:nowrap; }

    .a-icon-btn {
        width:38px; height:38px; border-radius:10px;
        background:var(--bg); border:1px solid var(--border);
        display:flex; align-items:center; justify-content:center;
        color:#64748b; cursor:pointer; text-decoration:none;
        transition:all .18s; flex-shrink:0; position:relative;
    }
    .a-icon-btn:hover { background:var(--teal-bg); color:var(--teal); border-color:rgba(6,187,204,.3); }
    .a-icon-btn i { font-size:1rem; }
    .a-icon-dot {
        position:absolute; top:7px; right:7px;
        width:7px; height:7px; border-radius:50%;
        background:var(--cfp-rose); border:2px solid #fff;
    }

    .a-profile-btn {
        display:flex; align-items:center; gap:8px;
        padding:4px 10px 4px 4px; background:var(--bg);
        border:1px solid var(--border); border-radius:10px;
        cursor:pointer; transition:all .18s; position:relative;
    }
    .a-profile-btn:hover { border-color:rgba(6,187,204,.4); background:var(--teal-bg); }
    .a-profile-avatar {
        width:30px; height:30px; border-radius:8px;
        background:linear-gradient(135deg,var(--teal),var(--teal-dark));
        display:flex; align-items:center; justify-content:center;
        color:#fff; font-weight:900; font-size:.7rem; flex-shrink:0;
    }
    .a-profile-name { font-size:.78rem; font-weight:800; color:var(--dark); white-space:nowrap; }

    .a-dropdown {
        position:absolute; top:calc(100% + 8px); right:0;
        background:#fff; border:1px solid var(--border); border-radius:12px;
        padding:6px; min-width:190px;
        box-shadow:0 8px 32px rgba(0,0,0,.12); z-index:9999; display:none;
    }
    .a-dropdown.show { display:block; }
    .a-dropdown a {
        display:flex; align-items:center; gap:8px;
        padding:9px 12px; border-radius:8px;
        color:#374151; font-size:.82rem; font-weight:700;
        text-decoration:none; transition:background .15s;
    }
    .a-dropdown a:hover { background:var(--bg); }
    .a-dropdown a.danger { color:#f43f5e; }
    .a-dropdown-divider { height:1px; background:var(--border); margin:4px 0; }

    .a-hamburger {
        display:none; width:38px; height:38px; border-radius:10px;
        background:var(--bg); border:1px solid var(--border);
        align-items:center; justify-content:center; cursor:pointer; flex-shrink:0;
    }
    .a-hamburger i { font-size:1.1rem; color:var(--dark); }

    /* ═══════════════ CONTENT ═══════════════ */
    .a-content { flex:1; padding:28px 24px; }
    .a-footer {
        padding:14px 24px; border-top:1px solid var(--border);
        background:#fff; font-size:.75rem; color:#94a3b8;
        display:flex; justify-content:space-between; align-items:center;
    }

    /* Mobile */
    .a-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,.5); z-index:999; }
    @media (max-width:768px) {
        .a-sidebar { transform:translateX(-100%); }
        .a-sidebar.open { transform:translateX(0); }
        .a-overlay.show { display:block; }
        .a-main { margin-left:0; }
        .a-hamburger { display:flex; }
        .a-content { padding:16px; }
        .a-header-date { display:none; }
    }

    /* ═══════════════ COMPONENT STYLES (shared) ═══════════════ */
    .dash-container { max-width:1400px; }
    .dash-page-header { display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; margin-bottom:28px; }
    .dash-page-title  { font-size:1.4rem; font-weight:900; color:var(--cfp-dark); margin:0; }
    .dash-page-subtitle{ color:#9ca3af; font-size:.875rem; margin:2px 0 0; }
    .dash-date-badge  { display:inline-flex; align-items:center; background:#fff; border:1px solid #e5e7eb; border-radius:10px; padding:8px 16px; font-size:.8rem; color:#6b7280; font-weight:700; }

    .dash-kpi-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(190px,1fr)); gap:18px; margin-bottom:24px; }
    .dash-kpi-card { position:relative; border-radius:16px; padding:22px 20px; overflow:hidden; color:#fff; box-shadow:0 4px 20px rgba(0,0,0,.12); transition:transform .2s,box-shadow .2s; }
    .dash-kpi-card:hover { transform:translateY(-3px); box-shadow:0 8px 32px rgba(0,0,0,.18); }
    .dash-kpi-teal    { background:linear-gradient(135deg,#06BBCC,#059aaa); }
    .dash-kpi-indigo  { background:linear-gradient(135deg,#4f46e5,#3730a3); }
    .dash-kpi-orange  { background:linear-gradient(135deg,#f59e0b,#d97706); }
    .dash-kpi-rose    { background:linear-gradient(135deg,#f43f5e,#be123c); }
    .dash-kpi-green   { background:linear-gradient(135deg,#10b981,#059669); }
    .dash-kpi-purple  { background:linear-gradient(135deg,#7c3aed,#5b21b6); }
    .dash-kpi-icon  { font-size:2rem; opacity:.22; margin-bottom:12px; display:block; }
    .dash-kpi-body  {}
    .dash-kpi-label { display:block; font-size:.7rem; font-weight:800; letter-spacing:1px; text-transform:uppercase; opacity:.8; }
    .dash-kpi-value { display:block; font-size:2.3rem; font-weight:900; line-height:1.1; margin:4px 0; }
    .dash-kpi-sub   { display:block; font-size:.7rem; opacity:.7; }
    .dash-kpi-wave  { position:absolute; bottom:-20px; right:-20px; width:100px; height:100px; border-radius:50%; background:rgba(255,255,255,.07); }
    .dash-kpi-wave::after { content:''; position:absolute; top:20px; left:20px; right:-20px; bottom:-20px; border-radius:50%; background:rgba(255,255,255,.05); }

    .dash-main-row { display:grid; grid-template-columns:1fr 300px; gap:18px; margin-bottom:24px; }
    @media(max-width:900px){ .dash-main-row{ grid-template-columns:1fr; } }

    .dash-card { background:#fff; border-radius:16px; padding:24px; box-shadow:0 1px 8px rgba(0,0,0,.06); border:1px solid #f1f5f9; margin-bottom:20px; }
    .dash-card:last-child { margin-bottom:0; }
    .dash-card-header { display:flex; align-items:flex-start; justify-content:space-between; gap:12px; margin-bottom:20px; }
    .dash-card-title   { font-size:.95rem; font-weight:900; color:var(--cfp-dark); margin:0; }
    .dash-card-subtitle{ font-size:.78rem; color:#9ca3af; margin:2px 0 0; }
    .dash-badge-teal  { display:inline-flex; align-items:center; background:rgba(6,187,204,.1); color:var(--cfp-teal); border-radius:8px; padding:4px 12px; font-size:.72rem; font-weight:800; white-space:nowrap; }
    .dash-badge-indigo{ display:inline-flex; align-items:center; background:rgba(79,70,229,.1); color:var(--cfp-indigo); border-radius:8px; padding:4px 12px; font-size:.72rem; font-weight:800; }

    .dash-actions-grid { display:grid; grid-template-columns:1fr 1fr; gap:10px; }
    .dash-action-btn {
        display:flex; flex-direction:column; align-items:center; justify-content:center;
        gap:6px; padding:14px 10px; border-radius:12px; text-decoration:none;
        font-size:.75rem; font-weight:800; transition:transform .15s,box-shadow .15s;
        border:none; cursor:pointer;
    }
    .dash-action-btn:hover { transform:translateY(-2px); box-shadow:0 6px 18px rgba(0,0,0,.12); text-decoration:none; }
    .dash-action-btn i { font-size:1.4rem; }
    .dash-action-teal   { background:rgba(6,187,204,.1);  color:var(--cfp-teal); }
    .dash-action-indigo { background:rgba(79,70,229,.1);  color:var(--cfp-indigo); }
    .dash-action-orange { background:rgba(245,158,11,.1); color:var(--cfp-orange); }
    .dash-action-rose   { background:rgba(244,63,94,.1);  color:var(--cfp-rose); }
    .dash-action-green  { background:rgba(16,185,129,.1); color:var(--cfp-green); }
    .dash-action-purple { background:rgba(124,58,237,.1); color:var(--cfp-purple); }

    .dash-table-wrap  { overflow-x:auto; border-radius:12px; }
    .dash-table       { width:100%; border-collapse:separate; border-spacing:0; font-size:.85rem; }
    .dash-table thead th { background:#f8fafc; color:#6b7280; font-size:.7rem; font-weight:800; letter-spacing:1px; text-transform:uppercase; padding:12px 16px; border-bottom:1px solid #e5e7eb; white-space:nowrap; }
    .dash-table tbody tr { transition:background .15s; }
    .dash-table tbody tr:hover { background:#f8fafc; }
    .dash-table tbody td { padding:13px 16px; border-bottom:1px solid #f1f5f9; vertical-align:middle; color:#374151; }
    .dash-table tbody tr:last-child td { border-bottom:none; }
    .dash-row-num     { display:inline-flex; align-items:center; justify-content:center; width:26px; height:26px; border-radius:8px; background:#f1f5f9; font-size:.75rem; font-weight:700; color:#9ca3af; }
    .dash-user-cell   { display:flex; align-items:center; gap:10px; }
    .dash-avatar      { width:34px; height:34px; border-radius:10px; flex-shrink:0; background:linear-gradient(135deg,#06BBCC,#059aaa); color:#fff; display:flex; align-items:center; justify-content:center; font-weight:900; font-size:.8rem; }
    .dash-user-name   { font-weight:800; font-size:.85rem; color:var(--cfp-dark); line-height:1.2; }
    .dash-user-sub    { font-size:.72rem; color:#9ca3af; }
    .dash-formation-tag{ display:inline-block; background:rgba(79,70,229,.1); color:var(--cfp-indigo); border-radius:8px; padding:3px 10px; font-size:.75rem; font-weight:700; }
    .dash-date-cell   { color:#6b7280; white-space:nowrap; }
    .dash-status-badge{ display:inline-flex; align-items:center; gap:4px; background:rgba(16,185,129,.1); color:#10b981; border-radius:8px; padding:4px 10px; font-size:.72rem; font-weight:700; }
    .dash-status-badge::before { content:''; width:6px; height:6px; border-radius:50%; background:#10b981; flex-shrink:0; }
    .dash-empty-state { text-align:center; padding:48px 20px; color:#9ca3af; }
    .dash-empty-state i { font-size:3rem; margin-bottom:12px; display:block; opacity:.4; }
    .dash-empty-state p { font-size:.9rem; margin:0; }
    .dash-chart-card  { min-width:0; }
    </style>
    <script>
    (function(){ var s=localStorage.getItem('cfp-theme'); if(s==='dark') document.documentElement.setAttribute('data-theme','dark'); })();
    </script>
</head>
<body>

<div class="a-overlay" id="aOverlay" onclick="closeASidebar()"></div>

<!-- ═══════════════ SIDEBAR ═══════════════ -->
<aside class="a-sidebar" id="aSidebar">

    <!-- Brand -->
    <div class="a-brand">
        <div class="a-brand-icon"><i class="fa fa-graduation-cap"></i></div>
        <div>
            <div class="a-brand-name">CFP Mon Cœur</div>
            <div class="a-brand-sub">Administration</div>
        </div>
    </div>

    <!-- Admin info card -->
    <div class="a-admin-card">
        <div class="a-admin-avatar">
            {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 2)) }}
        </div>
        <div>
            <div class="a-admin-name">{{ Str::limit(Auth::user()->name ?? '', 22) }}</div>
            <div class="a-admin-badge">
                <i class="bi bi-shield-fill-check" style="font-size:.65rem;"></i>
                Super Admin
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="a-nav">

        @php
            $pendingFormateurs = \App\Models\Formateur::where('approuve', false)->count();
            $unreadMessages    = class_exists(\App\Models\ContactMessage::class) ? \App\Models\ContactMessage::where('lu', false)->count() : 0;
            $currentRoute      = request()->route()?->getName() ?? '';
        @endphp

        <div class="a-nav-section">Tableau de bord</div>

        <a href="{{ route('dashboard') }}"
           class="a-nav-item {{ $currentRoute === 'dashboard' ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i>
            Tableau de bord
        </a>

        <div class="a-nav-section">Gestion</div>

        <a href="{{ route('formateur') }}"
           class="a-nav-item {{ $currentRoute === 'formateur' ? 'active' : '' }}">
            <i class="bi bi-person-badge-fill"></i>
            Formateurs
            @if($pendingFormateurs > 0)
                <span class="a-badge">{{ $pendingFormateurs }}</span>
            @endif
        </a>

        <a href="{{ route('etudiant') }}"
           class="a-nav-item {{ $currentRoute === 'etudiant' ? 'active' : '' }}">
            <i class="bi bi-mortarboard-fill"></i>
            Étudiants
        </a>

        <a href="{{ route('formation') }}"
           class="a-nav-item {{ $currentRoute === 'formation' ? 'active' : '' }}">
            <i class="bi bi-book-fill"></i>
            Formations
        </a>

        <a href="{{ route('inscription') }}"
           class="a-nav-item {{ $currentRoute === 'inscription' ? 'active' : '' }}">
            <i class="bi bi-pen-fill"></i>
            Inscriptions
        </a>

        <a href="{{ route('dons') }}"
           class="a-nav-item {{ $currentRoute === 'dons' ? 'active' : '' }}">
            <i class="bi bi-heart-fill"></i>
            Dons
        </a>

        <a href="{{ route('messages') }}"
           class="a-nav-item {{ $currentRoute === 'messages' ? 'active' : '' }}">
            <i class="bi bi-envelope-fill"></i>
            Messages
            @if($unreadMessages > 0)
                <span class="a-badge a-badge-teal">{{ $unreadMessages }}</span>
            @endif
        </a>

        <div class="a-nav-section">Système</div>

        <a href="{{ route('admins') }}"
           class="a-nav-item {{ $currentRoute === 'admins' ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i>
            Utilisateurs
        </a>

        <div class="a-nav-section">Site</div>

        <a href="{{ route('acceuil') }}" class="a-nav-item" target="_blank">
            <i class="bi bi-globe2"></i>
            Voir le site
        </a>

    </nav>

    <!-- Logout -->
    <div class="a-sidebar-footer">
        <form method="POST" action="{{ route('logout') }}"
              onsubmit="return confirm('Voulez-vous vraiment vous déconnecter ?')">
            @csrf
            <button type="submit" class="a-logout-btn">
                <i class="bi bi-box-arrow-left"></i>
                Déconnexion
            </button>
        </form>
    </div>

</aside>

<!-- ═══════════════ MAIN ═══════════════ -->
<div class="a-main">

    <!-- Header -->
    <header class="a-header">
        <div class="a-hamburger" onclick="openASidebar()"><i class="bi bi-list"></i></div>

        <p class="a-header-title d-none d-md-block">Administration CFP Mon Cœur</p>

        <span class="a-header-date d-none d-lg-block">
            {{ now()->locale('fr')->isoFormat('dddd D MMMM YYYY') }}
        </span>

        <!-- Notifications -->
        @if($pendingFormateurs > 0 || $unreadMessages > 0)
        <div class="a-icon-btn" title="Alertes en attente">
            <i class="bi bi-bell-fill"></i>
            <span class="a-icon-dot"></span>
        </div>
        @endif

        <!-- Dark mode toggle -->
        <button type="button" class="dm-toggle-be" onclick="cfpToggleDark()" title="Mode sombre / clair">
            <i class="bi bi-moon-fill dm-icon"></i>
        </button>

        <!-- Site link -->
        <a href="{{ route('acceuil') }}" class="a-icon-btn" target="_blank" title="Voir le site">
            <i class="bi bi-globe2"></i>
        </a>

        <!-- Profile dropdown -->
        <div style="position:relative;">
            <div class="a-profile-btn" onclick="toggleAProfile()" id="aProfileBtn">
                <div class="a-profile-avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 2)) }}
                </div>
                <span class="a-profile-name d-none d-md-block">
                    {{ Str::limit(Auth::user()->name ?? '', 18) }}
                </span>
                <i class="bi bi-chevron-down" style="font-size:.65rem;color:#94a3b8;margin-left:4px;"></i>
            </div>
            <div class="a-dropdown" id="aProfileMenu">
                <a href="{{ route('profile.show') }}">
                    <i class="bi bi-person-fill" style="color:#06BBCC;"></i> Mon profil
                </a>
                <a href="{{ route('admins') }}">
                    <i class="bi bi-shield-lock-fill" style="color:#4f46e5;"></i> Administrateurs
                </a>
                <div class="a-dropdown-divider"></div>
                <a href="#" class="danger"
                   onclick="event.preventDefault(); document.getElementById('aLogout').submit();">
                    <i class="bi bi-box-arrow-left"></i> Déconnexion
                </a>
                <form id="aLogout" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            </div>
        </div>
    </header>

    <!-- Content -->
    <main class="a-content">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="a-footer">
        <span>&copy; {{ date('Y') }} CFP Mon Cœur — Goma, RDC</span>
        <span>Développé par Christiane Mwenge</span>
    </footer>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.49.2/dist/apexcharts.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function openASidebar()  { document.getElementById('aSidebar').classList.add('open'); document.getElementById('aOverlay').classList.add('show'); }
function closeASidebar() { document.getElementById('aSidebar').classList.remove('open'); document.getElementById('aOverlay').classList.remove('show'); }
function toggleAProfile() { document.getElementById('aProfileMenu').classList.toggle('show'); }
document.addEventListener('click', function(e) {
    var btn = document.getElementById('aProfileBtn'), menu = document.getElementById('aProfileMenu');
    if (btn && menu && !btn.contains(e.target) && !menu.contains(e.target)) menu.classList.remove('show');
});

// Livewire events
document.addEventListener('livewire:init', function () {
    Livewire.on('showAlert', function (data) {
        var d = Array.isArray(data) ? data[0] : data;
        Swal.fire({
            icon: d.type || 'success',
            title: d.type === 'success' ? 'Succès !' : 'Erreur',
            text: d.message,
            timer: 2800, timerProgressBar: true,
            showConfirmButton: false,
            toast: true, position: 'top-end',
            customClass: { popup: 'swal2-toast' }
        });
    });
    Livewire.on('closeModal', function () {
        document.querySelectorAll('.modal').forEach(function(m) {
            var bm = bootstrap.Modal.getInstance(m);
            if (bm) bm.hide();
        });
    });
    Livewire.on('openModal', function () {
        var m = document.getElementById('formateurModal') || document.getElementById('mainModal');
        if (m) { new bootstrap.Modal(m).show(); }
    });
    Livewire.on('confirmDelete', function (data) {
        var d = Array.isArray(data) ? data[0] : data;
        Swal.fire({
            title: 'Confirmer la suppression ?',
            text: 'Cette action est irréversible.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f43f5e',
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Supprimer',
            cancelButtonText: 'Annuler'
        }).then(function(result) {
            if (result.isConfirmed) {
                Livewire.dispatch('deleteConfirmed', { id: d.id });
            }
        });
    });
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
