<nav id="mainNav" class="navbar navbar-expand-lg sticky-top p-0" style="background:var(--cfp-nav-bg,rgba(255,255,255,.97));backdrop-filter:blur(12px);border-bottom:1px solid var(--cfp-border,rgba(0,0,0,.08));transition:background .3s,box-shadow .3s;">

    <a href="{{ route('acceuil') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5 py-3" style="text-decoration:none;">
        <div style="width:38px;height:38px;background:linear-gradient(135deg,#06BBCC,#0f766e);border-radius:10px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 14px rgba(6,187,204,.4);flex-shrink:0;margin-right:10px;">
            <i class="fa fa-graduation-cap text-white" style="font-size:15px;"></i>
        </div>
        <span style="font-family:'Poppins',sans-serif;font-size:1.1rem;font-weight:800;color:var(--cfp-text,#0f172a);letter-spacing:-0.02em;">CFP Mon <span style="color:#06BBCC;">Cœur</span></span>
    </a>

    <button type="button" class="navbar-toggler me-3" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-label="Menu" style="border-color:var(--cfp-border);color:var(--cfp-text);">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav mx-auto p-4 p-lg-0 gap-lg-1">
            <a href="{{ route('acceuil') }}" class="cfp-nav-link {{ request()->routeIs('acceuil') ? 'cfp-nav-active' : '' }}">Accueil</a>
            <a href="{{ route('nos-formations') }}" class="cfp-nav-link {{ request()->routeIs('nos-formations') ? 'cfp-nav-active' : '' }}">Formations</a>
            <a href="{{ route('about') }}" class="cfp-nav-link {{ request()->routeIs('about') ? 'cfp-nav-active' : '' }}">À propos</a>
            <a href="{{ route('contact') }}" class="cfp-nav-link {{ request()->routeIs('contact') ? 'cfp-nav-active' : '' }}">Contact</a>
        </div>

        <div class="d-flex align-items-center pe-lg-4 gap-2 px-4 pb-4 px-lg-0 pb-lg-0 flex-wrap">
            <!-- Dark Mode Toggle -->
            <button type="button" class="dm-toggle" onclick="cfpToggleDark()" title="Mode sombre / clair">
                <i class="bi bi-moon-fill dm-icon"></i>
            </button>

            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-primary d-flex align-items-center gap-2" style="border-radius:0;font-weight:700;font-size:.85rem;padding:9px 20px;background:linear-gradient(135deg,#06BBCC,#0f766e);border:none;">
                    <i class="bi bi-grid-1x2-fill" style="font-size:12px;"></i> Tableau de bord
                </a>
            @else
                <a href="{{ route('login') }}" class="d-flex" style="font-weight:600;font-size:.875rem;color:var(--cfp-nav-link,#374151);text-decoration:none;padding:9px 4px;">
                    Connexion
                </a>
                <a href="{{ route('register') }}" class="btn btn-primary d-flex align-items-center" style="border-radius:0;font-weight:700;font-size:.85rem;padding:9px 22px;background:linear-gradient(135deg,#06BBCC,#0f766e);border:none;box-shadow:0 4px 14px rgba(6,187,204,.35);">
                    S'inscrire
                </a>
            @endauth
        </div>
    </div>
</nav>

<style>
.cfp-nav-link {
    display:flex; align-items:center;
    padding: 26px 14px;
    font-family:'Inter',sans-serif; font-weight:600; font-size:.875rem;
    color: var(--cfp-nav-link,#374151);
    text-decoration: none;
    position: relative;
    transition: color .2s;
}
.cfp-nav-link::after {
    content:''; position:absolute; bottom:0; left:14px; right:14px; height:2.5px;
    background: #06BBCC; border-radius:2px 2px 0 0;
    transform: scaleX(0); transition: transform .22s ease;
}
.cfp-nav-link:hover { color: #06BBCC !important; }
.cfp-nav-link:hover::after { transform: scaleX(1); }
.cfp-nav-active { color: #06BBCC !important; }
.cfp-nav-active::after { transform: scaleX(1); }
#mainNav.scrolled { box-shadow: 0 4px 24px rgba(15,23,42,.1); }
[data-theme="dark"] #mainNav .cfp-nav-link { color: var(--cfp-nav-link,#cbd5e1); }
[data-theme="dark"] #mainNav .cfp-nav-link:hover,
[data-theme="dark"] #mainNav .cfp-nav-active { color: #22d3ee !important; }
[data-theme="dark"] #mainNav.scrolled { box-shadow: 0 4px 24px rgba(0,0,0,.4); }
@media (max-width:991px) {
    .cfp-nav-link { padding: 10px 0; border-bottom:1px solid var(--cfp-border,rgba(0,0,0,.06)); }
    .cfp-nav-link::after { display:none; }
}
</style>
