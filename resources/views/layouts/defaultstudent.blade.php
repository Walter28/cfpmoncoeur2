<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'Mon Espace' }} — CFP Mon Cœur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('assets_backend/images/favicon.png?v=1') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 + Icons -->
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
        --teal-bg:   rgba(6,187,204,.08);
        --dark:      #0f172a;
        --slate:     #1e293b;
        --muted:     #94a3b8;
        --border:    #e8edf5;
        --bg:        #f4f7fb;
        --white:     #ffffff;
        --sidebar-w: 256px;
        --header-h:  64px;
        --radius:    14px;
    }

    /* ═══ DARK MODE ═══ */
    [data-theme="dark"] { --bg:#0f172a; --white:#1e293b; --border:rgba(255,255,255,.07); --dark:#f1f5f9; --muted:#64748b; --teal-bg:rgba(6,187,204,.08); }
    [data-theme="dark"] body { background:#0f172a!important; }
    [data-theme="dark"] .s-sidebar { background:#1e293b!important; border-color:rgba(255,255,255,.06)!important; }
    [data-theme="dark"] .s-sidebar-brand { border-color:rgba(255,255,255,.06)!important; }
    [data-theme="dark"] .s-sidebar-brand .brand-text { color:#f1f5f9!important; }
    [data-theme="dark"] .s-nav-item { color:#94a3b8!important; }
    [data-theme="dark"] .s-nav-item:hover,[data-theme="dark"] .s-nav-item.active { background:rgba(6,187,204,.12)!important; color:#06BBCC!important; }
    [data-theme="dark"] .s-header { background:#1e293b!important; border-color:rgba(255,255,255,.06)!important; box-shadow:0 1px 12px rgba(0,0,0,.35)!important; }
    [data-theme="dark"] .s-header-title { color:#f1f5f9!important; }
    [data-theme="dark"] .s-header-date { color:#64748b!important; }
    [data-theme="dark"] .s-header-icon-btn { background:rgba(255,255,255,.04)!important; border-color:rgba(255,255,255,.07)!important; color:#94a3b8!important; }
    [data-theme="dark"] .s-header-icon-btn:hover { background:rgba(6,187,204,.15)!important; color:#06BBCC!important; }
    [data-theme="dark"] .s-header-profile { background:rgba(255,255,255,.04)!important; border-color:rgba(255,255,255,.07)!important; }
    [data-theme="dark"] .s-header-profile-name { color:#f1f5f9!important; }
    [data-theme="dark"] .card,[data-theme="dark"] .bg-white { background:#1e293b!important; border-color:rgba(255,255,255,.07)!important; }
    [data-theme="dark"] .table { color:#cbd5e1!important; }
    [data-theme="dark"] thead th { background:rgba(255,255,255,.04)!important; color:#94a3b8!important; border-color:rgba(255,255,255,.06)!important; }
    [data-theme="dark"] td { border-color:rgba(255,255,255,.06)!important; }
    [data-theme="dark"] .form-control,[data-theme="dark"] .form-select,[data-theme="dark"] input:not([type=checkbox]):not([type=radio]),[data-theme="dark"] textarea { background:rgba(255,255,255,.05)!important; border-color:rgba(255,255,255,.1)!important; color:#f1f5f9!important; }
    [data-theme="dark"] .modal-content { background:#1e293b!important; border-color:rgba(255,255,255,.08)!important; }
    [data-theme="dark"] .modal-header,[data-theme="dark"] .modal-footer { border-color:rgba(255,255,255,.08)!important; }
    [data-theme="dark"] h1,[data-theme="dark"] h2,[data-theme="dark"] h3,[data-theme="dark"] h4,[data-theme="dark"] h5,[data-theme="dark"] h6 { color:#f1f5f9!important; }
    [data-theme="dark"] .text-muted { color:#64748b!important; }
    [data-theme="dark"] .s-sidebar-user { background:rgba(6,187,204,.08)!important; }
    .dm-toggle-be { width:38px;height:38px;border-radius:10px;background:var(--bg);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:#64748b;cursor:pointer;flex-shrink:0;transition:all .18s; }
    .dm-toggle-be:hover { background:rgba(6,187,204,.1);color:#06BBCC;border-color:rgba(6,187,204,.3); }

    /* ═══ BORDS CARRÉS — SQUARE DESIGN ═══ */
    .card,.modal-content,.bg-white { border-radius:0!important; }
    .btn,.badge { border-radius:2px!important; }
    .form-control,.form-select,input:not([type=checkbox]):not([type=radio]),textarea,select { border-radius:0!important; }
    .s-sidebar,.s-sidebar-brand { border-radius:0!important; }
    .s-header-icon-btn,.dm-toggle-be { border-radius:4px!important; }
    .s-header-profile { border-radius:4px!important; }
    .s-nav-item { border-radius:4px!important; }
    .brand-icon { border-radius:4px!important; }
    .s-sidebar-user { border-radius:0!important; }
    /* Fast transitions */
    .s-nav-item,.s-header-icon-btn,.dm-toggle-be,.btn,.form-control,.card,.s-header-profile { transition-duration:.1s!important; }

    html, body { height: 100%; margin: 0; font-family: 'Nunito', sans-serif; background: var(--bg); color: var(--dark); }

    /* ═══════════════ SIDEBAR ═══════════════ */
    .s-sidebar {
        position: fixed; top: 0; left: 0;
        width: var(--sidebar-w); height: 100vh;
        background: var(--white);
        border-right: 1px solid var(--border);
        display: flex; flex-direction: column;
        z-index: 1000; overflow: hidden;
        transition: transform .3s ease;
        box-shadow: 4px 0 20px rgba(0,0,0,.04);
    }

    .s-sidebar-brand {
        height: var(--header-h);
        padding: 0 20px;
        display: flex; align-items: center; gap: 10px;
        border-bottom: 1px solid var(--border);
        flex-shrink: 0;
    }
    .s-sidebar-brand .brand-icon {
        width: 36px; height: 36px;
        background: linear-gradient(135deg, var(--teal), var(--teal-dark));
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 4px 12px rgba(6,187,204,.3);
        flex-shrink: 0;
    }
    .s-sidebar-brand .brand-icon i { color: #fff; font-size: 15px; }
    .s-sidebar-brand .brand-text { font-weight: 800; font-size: .95rem; color: var(--dark); letter-spacing: -.02em; }
    .s-sidebar-brand .brand-sub  { font-size: .68rem; color: var(--muted); font-weight: 600; }

    .s-sidebar-user {
        padding: 16px 20px;
        display: flex; align-items: center; gap: 10px;
        background: var(--teal-bg);
        margin: 12px;
        border-radius: 12px;
        flex-shrink: 0;
    }
    .s-sidebar-avatar {
        width: 38px; height: 38px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--teal), var(--teal-dark));
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-weight: 800; font-size: .85rem;
        flex-shrink: 0;
    }
    .s-sidebar-user-name  { font-weight: 800; font-size: .85rem; color: var(--dark); line-height: 1.2; }
    .s-sidebar-user-role  { font-size: .68rem; color: var(--teal); font-weight: 700; }

    .s-nav { flex: 1; overflow-y: auto; padding: 8px 10px; }
    .s-nav::-webkit-scrollbar { width: 4px; }
    .s-nav::-webkit-scrollbar-track { background: transparent; }
    .s-nav::-webkit-scrollbar-thumb { background: var(--border); border-radius: 4px; }

    .s-nav-section { font-size: .62rem; font-weight: 800; color: var(--muted); letter-spacing: 1.2px; text-transform: uppercase; padding: 14px 10px 6px; }

    .s-nav-item {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 12px; border-radius: 10px;
        color: #64748b; font-size: .86rem; font-weight: 700;
        text-decoration: none; transition: all .18s;
        margin-bottom: 2px;
        cursor: pointer;
    }
    .s-nav-item i { font-size: 1.05rem; width: 20px; text-align: center; flex-shrink: 0; }
    .s-nav-item:hover { background: var(--teal-bg); color: var(--teal); text-decoration: none; }
    .s-nav-item.active { background: var(--teal-bg); color: var(--teal); }
    .s-nav-item.active i { color: var(--teal); }
    .s-nav-item .nav-badge {
        margin-left: auto;
        background: var(--teal); color: #fff;
        border-radius: 20px; padding: 2px 7px; font-size: .65rem; font-weight: 800;
    }

    .s-sidebar-footer {
        padding: 12px 10px;
        border-top: 1px solid var(--border);
        flex-shrink: 0;
    }

    /* ═══════════════ MAIN WRAPPER ═══════════════ */
    .s-main { margin-left: var(--sidebar-w); min-height: 100vh; display: flex; flex-direction: column; }

    /* ═══════════════ HEADER ═══════════════ */
    .s-header {
        height: var(--header-h);
        background: var(--white);
        border-bottom: 1px solid var(--border);
        padding: 0 24px;
        display: flex; align-items: center; gap: 16px;
        position: sticky; top: 0; z-index: 900;
        box-shadow: 0 1px 12px rgba(0,0,0,.04);
    }
    .s-header-title { font-weight: 800; font-size: 1rem; color: var(--dark); margin: 0; flex: 1; }
    .s-header-date   { font-size: .75rem; color: var(--muted); font-weight: 600; white-space: nowrap; }

    .s-header-icon-btn {
        width: 38px; height: 38px; border-radius: 10px;
        background: var(--bg); border: 1px solid var(--border);
        display: flex; align-items: center; justify-content: center;
        color: #64748b; cursor: pointer; text-decoration: none;
        transition: all .18s; position: relative;
        flex-shrink: 0;
    }
    .s-header-icon-btn:hover { background: var(--teal-bg); color: var(--teal); border-color: rgba(6,187,204,.3); }
    .s-header-icon-btn i { font-size: 1rem; }
    .s-header-notif-dot {
        position: absolute; top: 6px; right: 6px;
        width: 8px; height: 8px; border-radius: 50%;
        background: #f43f5e; border: 2px solid #fff;
    }

    .s-header-profile {
        display: flex; align-items: center; gap: 8px;
        padding: 4px 10px 4px 4px;
        background: var(--bg); border: 1px solid var(--border);
        border-radius: 10px; cursor: pointer;
        text-decoration: none; transition: all .18s;
        position: relative;
    }
    .s-header-profile:hover { border-color: rgba(6,187,204,.4); background: var(--teal-bg); }
    .s-header-profile-avatar {
        width: 30px; height: 30px; border-radius: 8px;
        background: linear-gradient(135deg, var(--teal), var(--teal-dark));
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-weight: 800; font-size: .7rem; flex-shrink: 0;
    }
    .s-header-profile-name { font-size: .78rem; font-weight: 800; color: var(--dark); white-space: nowrap; }

    .s-dropdown {
        position: absolute; top: calc(100% + 8px); right: 0;
        background: #fff; border: 1px solid var(--border);
        border-radius: 12px; padding: 6px; min-width: 180px;
        box-shadow: 0 8px 32px rgba(0,0,0,.12);
        z-index: 9999;
        display: none;
    }
    .s-dropdown.show { display: block; }
    .s-dropdown a {
        display: flex; align-items: center; gap: 8px;
        padding: 8px 12px; border-radius: 8px;
        color: #374151; font-size: .82rem; font-weight: 700;
        text-decoration: none; transition: background .15s;
    }
    .s-dropdown a:hover { background: var(--bg); }
    .s-dropdown a.danger { color: #f43f5e; }
    .s-dropdown-divider { height: 1px; background: var(--border); margin: 4px 0; }

    /* ═══════════════ CONTENT ═══════════════ */
    .s-content { flex: 1; padding: 28px 24px; }

    /* ═══════════════ MOBILE ═══════════════ */
    .s-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.4); z-index: 999; }
    .s-hamburger {
        display: none; width: 38px; height: 38px; border-radius: 10px;
        background: var(--bg); border: 1px solid var(--border);
        align-items: center; justify-content: center; cursor: pointer;
        flex-shrink: 0;
    }
    .s-hamburger i { font-size: 1.1rem; color: var(--dark); }

    @media (max-width: 768px) {
        .s-sidebar { transform: translateX(-100%); }
        .s-sidebar.open { transform: translateX(0); }
        .s-overlay.show { display: block; }
        .s-main { margin-left: 0; }
        .s-hamburger { display: flex; }
        .s-content { padding: 16px; }
    }
    </style>
    <script>
    (function(){ var s=localStorage.getItem('cfp-theme'); if(s==='dark') document.documentElement.setAttribute('data-theme','dark'); })();
    </script>
</head>
<body>

<!-- Overlay (mobile) -->
<div class="s-overlay" id="sOverlay" onclick="closeSidebar()"></div>

<!-- ═══ SIDEBAR ═══ -->
<aside class="s-sidebar" id="sSidebar">

    <!-- Brand -->
    <div class="s-sidebar-brand">
        <div class="brand-icon"><i class="fa fa-graduation-cap"></i></div>
        <div>
            <div class="brand-text">CFP Mon Cœur</div>
            <div class="brand-sub">Espace Étudiant</div>
        </div>
    </div>

    <!-- User card -->
    <div class="s-sidebar-user">
        <div class="s-sidebar-avatar">
            {{ strtoupper(substr(Auth::user()->name ?? 'E', 0, 2)) }}
        </div>
        <div>
            <div class="s-sidebar-user-name">{{ explode(' ', Auth::user()->name ?? '')[0] }}</div>
            <div class="s-sidebar-user-role">Étudiant</div>
        </div>
    </div>

    <!-- Nav -->
    <nav class="s-nav">
        <div class="s-nav-section">Principal</div>

        <a href="{{ route('dashboard') }}" class="s-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-door-fill"></i>
            Tableau de bord
        </a>

        <a href="{{ route('nos-formations') }}" class="s-nav-item {{ request()->routeIs('nos-formations') ? 'active' : '' }}">
            <i class="bi bi-book-fill"></i>
            Nos formations
        </a>

        <div class="s-nav-section">Explorer</div>

        <a href="{{ route('nos-formations') }}" class="s-nav-item {{ request()->routeIs('nos-formations') ? 'active' : '' }}">
            <i class="bi bi-search"></i>
            Voir toutes les formations
        </a>

        <a href="{{ route('contact') }}" class="s-nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
            <i class="bi bi-chat-dots-fill"></i>
            Contacter l'admin
        </a>

        <div class="s-nav-section">Compte</div>

        <a href="{{ route('mon.profil') }}" class="s-nav-item {{ request()->routeIs('mon.profil') ? 'active' : '' }}">
            <i class="bi bi-person-fill"></i>
            Mon profil
        </a>

    </nav>

    <!-- Footer (logout) -->
    <div class="s-sidebar-footer">
        <form method="POST" action="{{ route('logout') }}"
              onsubmit="return confirm('Voulez-vous vraiment vous déconnecter ?')">
            @csrf
            <button type="submit" class="s-nav-item w-100 border-0 bg-transparent" style="text-align:left;">
                <i class="bi bi-box-arrow-left" style="color:#f43f5e;"></i>
                <span style="color:#f43f5e;">Déconnexion</span>
            </button>
        </form>
    </div>

</aside>

<!-- ═══ MAIN ═══ -->
<div class="s-main">

    <!-- Header -->
    <header class="s-header">
        <!-- Hamburger (mobile) -->
        <div class="s-hamburger" id="sHamburger" onclick="openSidebar()">
            <i class="bi bi-list"></i>
        </div>

        <p class="s-header-title d-none d-md-block">
            Bonjour {{ explode(' ', Auth::user()->name ?? 'Étudiant')[0] }} 👋
        </p>

        <span class="s-header-date d-none d-lg-block">
            {{ now()->locale('fr')->isoFormat('dddd D MMMM YYYY') }}
        </span>

        <!-- Dark mode toggle -->
        <button type="button" class="dm-toggle-be" onclick="cfpToggleDark()" title="Mode sombre / clair">
            <i class="bi bi-moon-fill dm-icon"></i>
        </button>

        <!-- Site public link -->
        <a href="{{ route('acceuil') }}" class="s-header-icon-btn" target="_blank" title="Voir le site">
            <i class="bi bi-globe2"></i>
        </a>

        <!-- Profile dropdown -->
        <div style="position:relative;">
            <div class="s-header-profile" onclick="toggleProfileMenu()" id="profileBtn">
                <div class="s-header-profile-avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'E', 0, 2)) }}
                </div>
                <span class="s-header-profile-name d-none d-md-block">
                    {{ Str::limit(Auth::user()->name ?? '', 18) }}
                </span>
                <i class="bi bi-chevron-down" style="font-size:.7rem;color:#94a3b8;margin-left:4px;"></i>
            </div>
            <div class="s-dropdown" id="profileMenu">
                <a href="{{ route('mon.profil') }}">
                    <i class="bi bi-person-fill" style="color:#06BBCC;"></i> Mon profil
                </a>
                <div class="s-dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="danger"
                   onclick="if(!confirm('Voulez-vous vraiment vous déconnecter ?')) return; event.preventDefault(); document.getElementById('hLogout').submit();">
                    <i class="bi bi-box-arrow-left"></i> Déconnexion
                </a>
                <form id="hLogout" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            </div>
        </div>
    </header>

    <!-- Content -->
    <main class="s-content">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer style="padding:14px 24px;border-top:1px solid var(--border);background:#fff;font-size:.75rem;color:#94a3b8;display:flex;justify-content:space-between;align-items:center;">
        <span>&copy; {{ date('Y') }} CFP Mon Cœur — Goma, RDC</span>
        <span>Développé par Christiane Mwenge</span>
    </footer>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.49.2/dist/apexcharts.min.js"></script>

<script>
function openSidebar()  { document.getElementById('sSidebar').classList.add('open'); document.getElementById('sOverlay').classList.add('show'); }
function closeSidebar() { document.getElementById('sSidebar').classList.remove('open'); document.getElementById('sOverlay').classList.remove('show'); }
function toggleProfileMenu() {
    var m = document.getElementById('profileMenu');
    m.classList.toggle('show');
}
document.addEventListener('click', function(e) {
    var btn = document.getElementById('profileBtn');
    var menu = document.getElementById('profileMenu');
    if (btn && menu && !btn.contains(e.target) && !menu.contains(e.target)) {
        menu.classList.remove('show');
    }
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
