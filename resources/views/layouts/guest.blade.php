<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'CFP Mon Coeur') }} — {{ request()->routeIs('login') ? 'Connexion' : 'Inscription' }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Heebo:wght@400;500;600&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

        @livewireStyles

        <style>
            *, *::before, *::after { box-sizing: border-box; border-radius: 0 !important; }

            body {
                margin: 0;
                font-family: 'Heebo', sans-serif;
                background: #f5f7ff;
                min-height: 100vh;
                display: flex;
                align-items: stretch;
            }

            .auth-wrapper {
                display: flex;
                width: 100%;
                min-height: 100vh;
            }

            /* ── Brand Panel ── */
            .auth-brand {
                display: none;
                flex-direction: column;
                justify-content: center;
                align-items: flex-start;
                padding: 60px 56px;
                background: linear-gradient(145deg, #181d38 0%, #0d1a3a 40%, #06BBCC20 100%);
                position: relative;
                overflow: hidden;
                flex: 0 0 420px;
            }

            @media (min-width: 992px) {
                .auth-brand { display: flex; }
                .auth-form-col { flex: 1; }
            }

            .auth-brand::before {
                content: '';
                position: absolute;
                top: -120px; right: -120px;
                width: 400px; height: 400px;
                background: radial-gradient(circle, rgba(6,187,204,0.18) 0%, transparent 70%);
                border-radius: 50%;
            }

            .auth-brand::after {
                content: '';
                position: absolute;
                bottom: -80px; left: -80px;
                width: 300px; height: 300px;
                background: radial-gradient(circle, rgba(6,187,204,0.1) 0%, transparent 70%);
                border-radius: 50%;
            }

            .brand-logo {
                display: flex;
                align-items: center;
                gap: 14px;
                margin-bottom: 48px;
                position: relative; z-index: 1;
            }

            .brand-logo-icon {
                width: 52px; height: 52px;
                background: linear-gradient(135deg, #06BBCC, #059aaa);
                border-radius: 14px;
                display: flex; align-items: center; justify-content: center;
                box-shadow: 0 8px 24px rgba(6,187,204,0.4);
            }

            .brand-logo-icon i {
                color: white;
                font-size: 22px;
            }

            .brand-logo-name {
                font-family: 'Nunito', sans-serif;
                font-weight: 800;
                font-size: 1.4rem;
                color: #ffffff;
                line-height: 1.1;
            }

            .brand-logo-name span {
                display: block;
                font-size: 0.7rem;
                font-weight: 600;
                color: #06BBCC;
                letter-spacing: 3px;
                text-transform: uppercase;
            }

            .brand-tagline {
                font-family: 'Nunito', sans-serif;
                font-weight: 800;
                font-size: 2rem;
                color: #ffffff;
                line-height: 1.25;
                margin-bottom: 20px;
                position: relative; z-index: 1;
            }

            .brand-tagline em {
                font-style: normal;
                color: #06BBCC;
            }

            .brand-desc {
                color: rgba(255,255,255,0.65);
                font-size: 0.95rem;
                line-height: 1.7;
                margin-bottom: 40px;
                position: relative; z-index: 1;
            }

            .brand-features {
                list-style: none;
                padding: 0; margin: 0;
                position: relative; z-index: 1;
            }

            .brand-features li {
                display: flex;
                align-items: center;
                gap: 12px;
                color: rgba(255,255,255,0.8);
                font-size: 0.9rem;
                margin-bottom: 14px;
            }

            .brand-features li i {
                width: 32px; height: 32px;
                background: rgba(6,187,204,0.15);
                border: 1px solid rgba(6,187,204,0.3);
                border-radius: 8px;
                display: flex; align-items: center; justify-content: center;
                color: #06BBCC;
                font-size: 13px;
                flex-shrink: 0;
            }

            .brand-bottom {
                margin-top: auto;
                padding-top: 40px;
                font-size: 0.8rem;
                color: rgba(255,255,255,0.35);
                position: relative; z-index: 1;
            }

            /* ── Form Panel ── */
            .auth-form-col {
                flex: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 40px 24px;
                background: #f8faff;
            }

            .auth-form-inner {
                width: 100%;
                max-width: 420px;
            }

            .auth-form-header {
                text-align: center;
                margin-bottom: 32px;
            }

            .auth-form-header h1 {
                font-family: 'Nunito', sans-serif;
                font-weight: 800;
                font-size: 1.8rem;
                color: #181d38;
                margin: 0 0 8px;
            }

            .auth-form-header p {
                color: #6b7280;
                font-size: 0.9rem;
                margin: 0;
            }

            .auth-card {
                background: #ffffff;
                border-radius: 20px;
                padding: 36px;
                box-shadow: 0 8px 48px rgba(24,29,56,0.08), 0 1px 0 rgba(0,0,0,0.03);
            }

            /* Tailwind input override — more elegant */
            .auth-card input[type="text"],
            .auth-card input[type="email"],
            .auth-card input[type="password"] {
                border-radius: 10px !important;
                border-color: #e5e7eb !important;
                padding: 10px 14px !important;
                font-size: 0.925rem !important;
                transition: border-color 0.2s, box-shadow 0.2s !important;
                width: 100% !important;
                display: block !important;
            }

            .auth-card input:focus {
                border-color: #06BBCC !important;
                box-shadow: 0 0 0 3px rgba(6,187,204,0.15) !important;
                outline: none !important;
            }

            .auth-card label {
                font-weight: 600 !important;
                font-size: 0.85rem !important;
                color: #374151 !important;
                margin-bottom: 6px !important;
                display: block !important;
            }

            .auth-card button[type="submit"],
            .auth-card .btn-submit {
                width: 100%;
                padding: 12px 24px;
                background: linear-gradient(135deg, #06BBCC, #059aaa);
                color: white;
                border: none;
                border-radius: 10px;
                font-family: 'Nunito', sans-serif;
                font-weight: 700;
                font-size: 0.95rem;
                cursor: pointer;
                transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
                box-shadow: 0 4px 16px rgba(6,187,204,0.3);
                margin-top: 20px;
            }

            .auth-card button[type="submit"]:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 24px rgba(6,187,204,0.45);
            }

            .auth-card button[type="submit"]:active {
                transform: translateY(0);
            }

            .auth-divider {
                text-align: center;
                margin: 20px 0;
                color: #9ca3af;
                font-size: 0.85rem;
                position: relative;
            }

            .auth-switch {
                text-align: center;
                margin-top: 20px;
                font-size: 0.875rem;
                color: #6b7280;
            }

            .auth-switch a {
                color: #06BBCC;
                font-weight: 700;
                text-decoration: none;
            }

            .auth-switch a:hover {
                text-decoration: underline;
            }

            /* Override Jetstream default button */
            .auth-card [type="submit"] {
                background: linear-gradient(135deg, #06BBCC, #059aaa) !important;
                border-color: transparent !important;
                border-radius: 10px !important;
            }
        </style>
    </head>

    <body>
        <div class="auth-wrapper">

            {{-- Brand Panel --}}
            <div class="auth-brand">
                <div class="brand-logo">
                    <div class="brand-logo-icon">
                        <i class="fa fa-graduation-cap"></i>
                    </div>
                    <div class="brand-logo-name">
                        CFP Mon Coeur
                        <span>Centre de Formation</span>
                    </div>
                </div>

                <h1 class="brand-tagline">
                    Construis ton avenir<br>avec les <em>bonnes compétences</em>
                </h1>

                <p class="brand-desc">
                    Rejoignez des centaines d'étudiants qui ont transformé leur carrière grâce à nos formations pratiques et professionnelles.
                </p>

                <ul class="brand-features">
                    <li>
                        <i class="fas fa-user-tie"></i>
                        Formateurs certifiés et expérimentés
                    </li>
                    <li>
                        <i class="fas fa-certificate"></i>
                        Certifications reconnues
                    </li>
                    <li>
                        <i class="fas fa-hand-holding-heart"></i>
                        Accompagnement personnalisé
                    </li>
                    <li>
                        <i class="fas fa-briefcase"></i>
                        Accès au réseau professionnel
                    </li>
                </ul>

                <p class="brand-bottom">
                    © {{ date('Y') }} CFP Mon Coeur — Goma, RDC
                </p>
            </div>

            {{-- Form Panel --}}
            <div class="auth-form-col">
                <div class="auth-form-inner">
                    {{ $slot }}
                </div>
            </div>
        </div>

        @livewireScripts
    </body>
</html>
