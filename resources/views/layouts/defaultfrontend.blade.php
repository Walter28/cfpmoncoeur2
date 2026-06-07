<!DOCTYPE html>
<html lang="fr" data-theme="light">

<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'CFP Mon Cœur' }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Centre de Formation Professionnelle, Goma, RDC" name="description">

    <link rel="icon" type="image/png" href="{{ asset('assets_backend/images/favicon.png?v=1') }}">

    <!-- Fonts: Poppins + Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700;800;900&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="{{ asset('assets_frontend/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_frontend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_frontend/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_frontend/css/custom.css') }}" rel="stylesheet">

    <style>
    /* ═══════════════ DARK MODE CSS VARIABLES ═══════════════ */
    :root {
        --cfp-bg:          #ffffff;
        --cfp-bg2:         #f8fafc;
        --cfp-bg3:         #f1f5f9;
        --cfp-warm:        #fdf4f0;
        --cfp-text:        #0f172a;
        --cfp-muted:       #64748b;
        --cfp-card:        #ffffff;
        --cfp-border:      rgba(0,0,0,0.08);
        --cfp-nav-bg:      rgba(255,255,255,0.97);
        --cfp-nav-text:    #0f172a;
        --cfp-nav-link:    #374151;
        --cfp-nav-active:  #06BBCC;
        --cfp-shadow:      rgba(15,23,42,0.08);
        --cfp-shadow-lg:   rgba(15,23,42,0.15);
        --cfp-input-bg:    #ffffff;
        --cfp-input-border:#e2e8f0;
        --cfp-teal:        #06BBCC;
        --cfp-teal-dark:   #059aaa;
    }

    [data-theme="dark"] {
        --cfp-bg:          #0f172a;
        --cfp-bg2:         #1e293b;
        --cfp-bg3:         #1e293b;
        --cfp-warm:        #1a1f35;
        --cfp-text:        #f1f5f9;
        --cfp-muted:       #94a3b8;
        --cfp-card:        #1e293b;
        --cfp-border:      rgba(255,255,255,0.07);
        --cfp-nav-bg:      rgba(15,23,42,0.97);
        --cfp-nav-text:    #f1f5f9;
        --cfp-nav-link:    #cbd5e1;
        --cfp-nav-active:  #22d3ee;
        --cfp-shadow:      rgba(0,0,0,0.3);
        --cfp-shadow-lg:   rgba(0,0,0,0.5);
        --cfp-input-bg:    #1e293b;
        --cfp-input-border:#334155;
    }

    /* ═══════════════ GLOBAL DARK MODE OVERRIDES ═══════════════ */
    html,
    body {
        display: block !important;
        width: 100%;
        min-height: 100%;
        overflow-x: hidden;
    }

    body {
        background: var(--cfp-bg) !important;
        color: var(--cfp-text) !important;
        font-family: 'Inter', 'Nunito', sans-serif;
        transition: background .3s ease, color .3s ease;
    }

    /* Navbar */
    [data-theme="dark"] .navbar.scrolled,
    [data-theme="dark"] #mainNav {
        background: var(--cfp-nav-bg) !important;
        border-bottom: 1px solid var(--cfp-border) !important;
    }
    [data-theme="dark"] .navbar .nav-link,
    [data-theme="dark"] .navbar .navbar-brand h2 {
        color: var(--cfp-nav-link) !important;
    }
    [data-theme="dark"] .navbar .nav-link:hover,
    [data-theme="dark"] .navbar .nav-link.active {
        color: var(--cfp-nav-active) !important;
    }

    /* Cards & sections */
    [data-theme="dark"] .course-item,
    [data-theme="dark"] .team-item,
    [data-theme="dark"] .service-item,
    [data-theme="dark"] .bg-light,
    [data-theme="dark"] .bg-white {
        background: var(--cfp-card) !important;
        border-color: var(--cfp-border) !important;
    }
    [data-theme="dark"] .testimonial-text.bg-white {
        background: var(--cfp-bg2) !important;
        border-color: var(--cfp-border) !important;
    }

    /* Text */
    [data-theme="dark"] h1, [data-theme="dark"] h2,
    [data-theme="dark"] h3, [data-theme="dark"] h4,
    [data-theme="dark"] h5, [data-theme="dark"] h6 {
        color: var(--cfp-text) !important;
    }
    [data-theme="dark"] p,
    [data-theme="dark"] .text-muted,
    [data-theme="dark"] small {
        color: var(--cfp-muted) !important;
    }

    /* Sections */
    [data-theme="dark"] .section-warm,
    [data-theme="dark"] .section-neutral,
    [data-theme="dark"] .container-xxl {
        background: var(--cfp-bg) !important;
    }
    [data-theme="dark"] .stats-bar {
        background: var(--cfp-bg2) !important;
        border-color: var(--cfp-border) !important;
    }
    [data-theme="dark"] .welcome-strip {
        background: var(--cfp-bg2) !important;
        border-color: var(--cfp-border) !important;
    }
    [data-theme="dark"] .welcome-badge {
        background: rgba(6,187,204,0.15) !important;
        color: #22d3ee !important;
    }

    /* Forms / inputs */
    [data-theme="dark"] input,
    [data-theme="dark"] textarea,
    [data-theme="dark"] select,
    [data-theme="dark"] .form-control {
        background: var(--cfp-input-bg) !important;
        border-color: var(--cfp-input-border) !important;
        color: var(--cfp-text) !important;
    }

    /* Footer stays dark always */
    .cfp-footer { background: #0a0f1e !important; }

    /* Spinner */
    [data-theme="dark"] #spinner {
        background: var(--cfp-bg) !important;
    }

    /* Dark mode toggle button */
    .dm-toggle {
        width: 40px; height: 40px;
        border-radius: 50%;
        border: 1.5px solid var(--cfp-border);
        background: var(--cfp-bg2);
        color: var(--cfp-text);
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        transition: all .2s ease;
        font-size: 1rem;
        flex-shrink: 0;
    }
    .dm-toggle:hover {
        background: var(--cfp-teal);
        color: #fff;
        border-color: var(--cfp-teal);
        transform: rotate(15deg);
    }

    /* Navbar scrolled dark mode */
    [data-theme="dark"] .navbar.scrolled { box-shadow: 0 4px 20px rgba(0,0,0,0.4) !important; }

    /* About feature pill dark */
    [data-theme="dark"] .about-feature-pill {
        background: var(--cfp-bg2) !important;
        color: var(--cfp-text) !important;
    }

    /* FAQ dark */
    [data-theme="dark"] .faq-item { background: var(--cfp-card) !important; border-color: var(--cfp-border) !important; }
    [data-theme="dark"] .faq-question { color: var(--cfp-text) !important; }
    [data-theme="dark"] .faq-answer { color: var(--cfp-muted) !important; border-color: var(--cfp-border) !important; }

    /* Steps dark */
    [data-theme="dark"] .step-card { background: var(--cfp-card) !important; border-color: var(--cfp-border) !important; }
    [data-theme="dark"] .step-card h5, [data-theme="dark"] .step-card p { color: var(--cfp-muted) !important; }

    /* Scrollbar */
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: var(--cfp-bg); }
    ::-webkit-scrollbar-thumb { background: var(--cfp-teal); border-radius: 3px; }
    </style>

    <!-- Dark Mode Init (must run before body renders to prevent flash) -->
    <script>
    (function(){
        var saved = localStorage.getItem('cfp-theme');
        if (saved === 'dark') {
            document.documentElement.setAttribute('data-theme','dark');
        }
    })();
    </script>

    @livewireStyles
</head>

<body>
    <!-- Spinner -->
    <div id="spinner" class="show position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex flex-column align-items-center justify-content-center" style="background:var(--cfp-bg);z-index:9999;">
    </div>

    <!-- Navbar -->
    @include('layouts.partials.navfront')

    <!-- Content -->
    {{ $slot }}

    <!-- Footer -->
    @include('layouts.partials.footerfront')

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top" aria-label="Retour en haut"><i class="bi bi-arrow-up"></i></a>

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="{{ asset('assets_frontend/lib/wow/wow.min.js') }}" defer></script>
    <script src="{{ asset('assets_frontend/lib/easing/easing.min.js') }}" defer></script>
    <script src="{{ asset('assets_frontend/lib/waypoints/waypoints.min.js') }}" defer></script>
    <script src="{{ asset('assets_frontend/lib/owlcarousel/owl.carousel.min.js') }}" defer></script>
    <script src="{{ asset('assets_frontend/js/main.js') }}" defer></script>

    <!-- Navbar scroll -->
    <script>
    (function() {
        window.addEventListener('scroll', function() {
            var nav = document.querySelector('#mainNav');
            if (!nav) return;
            nav.classList.toggle('scrolled', window.scrollY > 60);
        }, { passive: true });
    })();

    /* Dark Mode Toggle */
    function cfpToggleDark() {
        var html = document.documentElement;
        var isDark = html.getAttribute('data-theme') === 'dark';
        if (isDark) {
            html.setAttribute('data-theme','light');
            localStorage.setItem('cfp-theme','light');
        } else {
            html.setAttribute('data-theme','dark');
            localStorage.setItem('cfp-theme','dark');
        }
        /* Update all toggle icons */
        document.querySelectorAll('.dm-icon').forEach(function(el){
            el.className = isDark ? 'bi bi-moon-fill dm-icon' : 'bi bi-sun-fill dm-icon';
        });
    }
    /* Sync icon on load */
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
