<footer class="cfp-footer">
    <div class="cfp-footer-top">
        <div class="container">
            <div class="row g-5">

                <!-- Col 1 — Brand -->
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <div style="width:42px;height:42px;background:linear-gradient(135deg,#06BBCC,#0f766e);border-radius:11px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="fa fa-graduation-cap text-white" style="font-size:17px;"></i>
                        </div>
                        <span style="font-family:'Poppins',sans-serif;font-size:1.2rem;font-weight:800;color:#fff;letter-spacing:-0.02em;">CFP Mon <span style="color:#06BBCC;">Cœur</span></span>
                    </div>
                    <p style="color:#64748b;line-height:1.8;font-size:.9rem;max-width:300px;">
                        Centre de Formation Professionnelle à Goma, RDC. Nous transformons les talents en compétences concrètes pour construire l'avenir professionnel africain.
                    </p>
                    <div class="d-flex gap-2 mt-4">
                        <a href="#" class="cfp-social-btn" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="cfp-social-btn" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="cfp-social-btn" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="cfp-social-btn" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="cfp-social-btn" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    </div>
                    <div class="cfp-footer-badge mt-4">
                        <i class="bi bi-shield-check-fill" style="color:#06BBCC;font-size:1.1rem;flex-shrink:0;"></i>
                        <div>
                            <div style="font-weight:700;font-size:.82rem;color:#e2e8f0;">Certifié & Reconnu</div>
                            <div style="font-size:.72rem;color:#475569;">Goma, RDC — depuis 2020</div>
                        </div>
                    </div>
                </div>

                <!-- Col 2 — Formations -->
                <div class="col-lg-2 col-md-6">
                    <h5 class="cfp-footer-title">Formations</h5>
                    <ul class="cfp-footer-links">
                        <li><a href="{{ route('nos-formations') }}">Développement Web</a></li>
                        <li><a href="{{ route('nos-formations') }}">Marketing Digital</a></li>
                        <li><a href="{{ route('nos-formations') }}">Design Graphique</a></li>
                        <li><a href="{{ route('nos-formations') }}">Informatique</a></li>
                        <li><a href="{{ route('nos-formations') }}">Langues</a></li>
                        <li><a href="{{ route('nos-formations') }}">Business & Gestion</a></li>
                    </ul>
                </div>

                <!-- Col 3 — Liens rapides -->
                <div class="col-lg-2 col-md-6">
                    <h5 class="cfp-footer-title">Liens rapides</h5>
                    <ul class="cfp-footer-links">
                        <li><a href="{{ route('acceuil') }}">Accueil</a></li>
                        <li><a href="{{ route('about') }}">À propos</a></li>
                        <li><a href="{{ route('nos-formations') }}">Toutes les formations</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                        <li><a href="{{ route('contact') }}">FAQ & Aide</a></li>
                        @guest
                        <li><a href="{{ route('register') }}">S'inscrire</a></li>
                        @endguest
                        @auth
                        <li><a href="{{ route('dashboard') }}">Mon espace</a></li>
                        @endauth
                    </ul>
                </div>

                <!-- Col 4 — Contact + Newsletter -->
                <div class="col-lg-4 col-md-6">
                    <h5 class="cfp-footer-title">Contactez-nous</h5>
                    <ul class="cfp-footer-contact mb-4">
                        <li>
                            <div class="cfp-contact-icon"><i class="bi bi-geo-alt-fill"></i></div>
                            <span>Avenue de la Paix, Goma, Nord-Kivu, RDC</span>
                        </li>
                        <li>
                            <div class="cfp-contact-icon"><i class="bi bi-telephone-fill"></i></div>
                            <span>+243 000 000 000</span>
                        </li>
                        <li>
                            <div class="cfp-contact-icon"><i class="bi bi-envelope-fill"></i></div>
                            <span>cfpmoncoeur@gmail.com</span>
                        </li>
                        <li>
                            <div class="cfp-contact-icon"><i class="bi bi-clock-fill"></i></div>
                            <span>Lun – Sam : 8h00 – 18h00</span>
                        </li>
                    </ul>

                    <div style="font-weight:700;font-size:.875rem;color:#e2e8f0;margin-bottom:10px;">
                        <i class="bi bi-envelope-heart-fill me-2" style="color:#06BBCC;"></i>Newsletter
                    </div>
                    <p style="color:#475569;font-size:.82rem;margin-bottom:10px;">Recevez nos actualités et nouvelles formations.</p>
                    <form action="#" method="post" class="cfp-newsletter-form">
                        @csrf
                        <input type="email" name="email" placeholder="Votre adresse email..." required>
                        <button type="submit" title="S'inscrire"><i class="bi bi-send-fill"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="cfp-footer-bottom">
        <div class="container">
            <div class="row align-items-center g-3">
                <div class="col-md-6">
                    <p class="mb-0" style="color:#475569;font-size:.82rem;">
                        © {{ date('Y') }} <a href="{{ route('acceuil') }}" style="color:#06BBCC;text-decoration:none;font-weight:700;">CFP Mon Cœur</a>. Tous droits réservés.
                        <span style="color:#1e293b;margin:0 6px;">·</span>
                        Développé par <a href="#" style="color:#06BBCC;text-decoration:none;font-weight:700;">Christiane MWENGE</a>
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="d-flex gap-4 justify-content-md-end" style="font-size:.82rem;">
                        <a href="{{ route('contact') }}" class="cfp-footer-bottom-link">Confidentialité</a>
                        <a href="{{ route('contact') }}" class="cfp-footer-bottom-link">Conditions</a>
                        <a href="{{ route('contact') }}" class="cfp-footer-bottom-link">FAQ</a>
                        <a href="{{ route('contact') }}" class="cfp-footer-bottom-link">Cookies</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
.cfp-footer { background:#080d1a; border-top:1px solid rgba(255,255,255,.04); }
.cfp-footer-top { padding:70px 0 50px; }
.cfp-footer-bottom { border-top:1px solid rgba(255,255,255,.06); padding:20px 0; }

.cfp-footer-title {
    font-family:'Poppins',sans-serif; font-weight:700; font-size:.82rem;
    color:#f1f5f9; letter-spacing:.08em; text-transform:uppercase;
    margin-bottom:20px; padding-bottom:10px;
    border-bottom:2px solid rgba(6,187,204,.2);
    display:inline-block;
}

.cfp-footer-links { list-style:none; padding:0; margin:0; }
.cfp-footer-links li { margin-bottom:9px; }
.cfp-footer-links li a {
    color:#475569; text-decoration:none; font-size:.875rem;
    display:inline-flex; align-items:center; gap:0;
    transition:color .2s, gap .2s;
}
.cfp-footer-links li a:hover { color:#06BBCC; gap:6px; }

.cfp-social-btn {
    width:38px; height:38px; border-radius:50%;
    background:rgba(255,255,255,.05); border:1px solid rgba(255,255,255,.08);
    color:#475569; display:flex; align-items:center; justify-content:center;
    font-size:.8rem; text-decoration:none; transition:all .22s;
}
.cfp-social-btn:hover { background:#06BBCC; border-color:#06BBCC; color:#fff; transform:translateY(-3px); }

.cfp-footer-contact { list-style:none; padding:0; margin:0; }
.cfp-footer-contact li { display:flex; align-items:flex-start; gap:12px; margin-bottom:13px; }
.cfp-contact-icon {
    width:32px; height:32px; flex-shrink:0; border-radius:8px;
    background:rgba(6,187,204,.1); color:#06BBCC;
    display:flex; align-items:center; justify-content:center; font-size:.82rem;
}
.cfp-footer-contact li span { color:#475569; font-size:.875rem; line-height:1.5; }

.cfp-newsletter-form {
    display:flex; background:rgba(255,255,255,.05);
    border:1px solid rgba(255,255,255,.09); border-radius:10px; overflow:hidden;
}
.cfp-newsletter-form input {
    flex:1; background:transparent; border:none; outline:none;
    padding:10px 14px; color:#e2e8f0; font-size:.875rem;
}
.cfp-newsletter-form input::placeholder { color:#334155; }
.cfp-newsletter-form button {
    background:linear-gradient(135deg,#06BBCC,#0f766e);
    border:none; padding:10px 16px; color:#fff; cursor:pointer; transition:opacity .2s;
}
.cfp-newsletter-form button:hover { opacity:.85; }

.cfp-footer-badge {
    display:inline-flex; align-items:center; gap:10px;
    background:rgba(6,187,204,.07); border:1px solid rgba(6,187,204,.18);
    border-radius:10px; padding:10px 14px;
}

.cfp-footer-bottom-link {
    color:#334155; text-decoration:none; transition:color .2s;
}
.cfp-footer-bottom-link:hover { color:#06BBCC; }
</style>
