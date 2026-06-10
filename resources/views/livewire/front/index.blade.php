<div>
<style>
/* ═══════════════ HERO V2 — PHOTO BACKGROUND ═══════════════ */
.hero-v2 { min-height:72vh;position:relative;overflow:hidden;display:flex;align-items:center; }
.hero-bg { position:absolute;inset:0;z-index:0; }
.hero-bg-slide { position:absolute;inset:0;background-size:cover;background-position:center;opacity:0;transition:opacity 1.4s cubic-bezier(.4,0,.2,1);transform:scale(1.04);will-change:opacity,transform; }
.hero-bg-slide.hbs-active { opacity:1;transform:scale(1); transition:opacity 1.4s cubic-bezier(.4,0,.2,1),transform 8s linear; }
.hero-overlay { position:absolute;inset:0;z-index:1;background:linear-gradient(to right,rgba(4,8,20,.88) 0%,rgba(4,8,20,.68) 50%,rgba(4,8,20,.35) 100%); }

/* ═══ TITRE & SOUS-TITRE — TRANSITIONS STAGGERÉES ═══ */
.hero-slide-text { position:absolute;inset:0;opacity:0;pointer-events:none; }
.hero-slide-text.hs-active { opacity:1;pointer-events:auto; }

.hero-slide-text h1 {
    opacity:0;
    transform:translateX(-40px) translateY(8px);
    transition:opacity 0s,transform 0s;
}
.hero-slide-text p {
    opacity:0;
    transform:translateX(-30px);
    transition:opacity 0s,transform 0s;
}
.hero-slide-text .hero-cta-wrap {
    opacity:0;
    transform:translateY(14px);
    transition:opacity 0s,transform 0s;
}
.hero-slide-text.hs-active h1 {
    opacity:1;
    transform:translateX(0) translateY(0);
    transition:opacity .65s cubic-bezier(.22,1,.36,1) .1s,
               transform .65s cubic-bezier(.22,1,.36,1) .1s;
}
.hero-slide-text.hs-active p {
    opacity:1;
    transform:translateX(0);
    transition:opacity .65s cubic-bezier(.22,1,.36,1) .28s,
               transform .65s cubic-bezier(.22,1,.36,1) .28s;
}
.hero-slide-text.hs-active .hero-cta-wrap {
    opacity:1;
    transform:translateY(0);
    transition:opacity .55s cubic-bezier(.22,1,.36,1) .44s,
               transform .55s cubic-bezier(.22,1,.36,1) .44s;
}
.hero-text-wrap { position:relative;min-height:210px; }

.hero-badge-v2 {
    display:inline-flex;align-items:center;gap:8px;
    background:rgba(6,187,204,.14);border:1px solid rgba(6,187,204,.35);
    border-radius:2px;padding:7px 16px;
    font-size:.75rem;font-weight:700;letter-spacing:.08em;color:#22d3ee;text-transform:uppercase;margin-bottom:24px;
}
.hero-pulse { width:8px;height:8px;border-radius:50%;background:#22d3ee;flex-shrink:0;box-shadow:0 0 0 0 rgba(34,211,238,.4);animation:hpulse 1.8s ease-out infinite; }
@keyframes hpulse { 0%{box-shadow:0 0 0 0 rgba(34,211,238,.5)} 70%{box-shadow:0 0 0 8px rgba(34,211,238,0)} 100%{box-shadow:0 0 0 0 rgba(34,211,238,0)} }

.btn-hero-main { display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,#06BBCC,#0f766e);color:#fff;font-family:'Poppins',sans-serif;font-weight:700;font-size:.9rem;padding:13px 28px;border-radius:0;text-decoration:none;box-shadow:0 8px 28px rgba(6,187,204,.4);transition:all .15s; }
.btn-hero-main:hover { transform:translateY(-2px);box-shadow:0 12px 36px rgba(6,187,204,.55);color:#fff; }
.btn-hero-ghost { display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,.07);border:1.5px solid rgba(255,255,255,.22);backdrop-filter:blur(8px);color:rgba(255,255,255,.88);font-family:'Poppins',sans-serif;font-weight:600;font-size:.9rem;padding:13px 24px;border-radius:0;text-decoration:none;transition:all .15s; }
.btn-hero-ghost:hover { background:rgba(255,255,255,.14);color:#fff;transform:translateY(-2px); }

.hero-mini-stats { display:flex;gap:24px;flex-wrap:wrap;margin-top:32px;align-items:center; }
.hero-stat-num { display:block;font-family:'Poppins',sans-serif;font-size:1.5rem;font-weight:800;color:#fff;line-height:1; }
.hero-stat-lbl { font-size:.7rem;color:rgba(255,255,255,.4);font-weight:500;letter-spacing:.04em;text-transform:uppercase; }
.hero-stat-sep { width:1px;height:36px;background:rgba(255,255,255,.12); }

.hero-dots-v2 { display:flex;gap:8px;margin-top:28px; }
.hero-dot-v2 { width:8px;height:8px;border-radius:2px;background:rgba(255,255,255,.25);border:none;cursor:pointer;transition:all .15s;padding:0; }
.hero-dot-v2.hd-active { background:#06BBCC;width:28px; }

.hero-arrow { position:absolute;top:50%;transform:translateY(-50%);z-index:5;width:44px;height:44px;border:1.5px solid rgba(255,255,255,.2);color:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .15s;backdrop-filter:blur(6px);background:rgba(255,255,255,.08);border-radius:0;padding:0; }
.hero-arrow:hover { background:rgba(6,187,204,.65);border-color:rgba(6,187,204,.5); }
.hero-arrow-prev { left:16px; }
.hero-arrow-next { right:16px; }

/* ═══════════════ STATS BAR ═══════════════ */
.stats-bar-v2 { background:var(--cfp-bg2,#f8fafc);border-bottom:1px solid var(--cfp-border,rgba(0,0,0,.06)); }
.stat-v2 { padding:26px 20px;text-align:center;border-right:1px solid var(--cfp-border,rgba(0,0,0,.06));transition:background .2s; }
.stat-v2:last-child { border-right:none; }
.stat-v2:hover { background:rgba(6,187,204,.04); }
.stat-v2-num { display:block;font-family:'Poppins',sans-serif;font-weight:800;font-size:1.8rem;color:#06BBCC;line-height:1; }
.stat-v2-lbl { font-size:.76rem;color:var(--cfp-muted,#64748b);font-weight:500;margin-top:4px;display:block; }

/* ═══════════════ SECTION HELPERS ═══════════════ */
.sec-label {
    display:inline-flex;align-items:center;gap:8px;
    background:rgba(6,187,204,.1);border:1px solid rgba(6,187,204,.2);
    border-radius:50px;padding:5px 16px;
    font-size:.72rem;font-weight:700;letter-spacing:.06em;color:#06BBCC;text-transform:uppercase;margin-bottom:14px;
}
.sec-title { font-family:'Poppins',sans-serif;font-weight:800;color:var(--cfp-text,#0f172a);font-size:clamp(1.5rem,3vw,2.3rem);line-height:1.2; }
.sec-sub { color:var(--cfp-muted,#64748b);font-size:.93rem;line-height:1.72;max-width:520px; }
.sec-bg { background:var(--cfp-bg,#fff); }
.sec-bg-alt { background:var(--cfp-bg2,#f8fafc); }

/* ═══════════════ WHY CARDS ═══════════════ */
.why-card { background:var(--cfp-card,#fff);border:1px solid var(--cfp-border,rgba(0,0,0,.06));border-radius:20px;padding:30px 24px;transition:all .3s;height:100%; }
.why-card:hover { transform:translateY(-6px);box-shadow:0 20px 50px var(--cfp-shadow-lg,rgba(15,23,42,.12));border-color:rgba(6,187,204,.3); }
.why-icon { width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;margin-bottom:18px;background:rgba(6,187,204,.1);color:#06BBCC;transition:all .3s; }
.why-card:hover .why-icon { background:linear-gradient(135deg,#06BBCC,#0f766e);color:#fff; }
.why-card h5 { font-family:'Poppins',sans-serif;font-weight:700;font-size:1rem;color:var(--cfp-text,#0f172a);margin-bottom:8px; }
.why-card p { color:var(--cfp-muted,#64748b);font-size:.86rem;line-height:1.65;margin:0; }

/* ═══════════════ FORMATION CARD V2 ═══════════════ */
.fc2-card { background:var(--cfp-card,#fff);border:1px solid var(--cfp-border,rgba(0,0,0,.06));border-radius:20px;overflow:hidden;transition:all .3s;height:100%;display:flex;flex-direction:column; }
.fc2-card:hover { transform:translateY(-6px);box-shadow:0 24px 50px var(--cfp-shadow-lg,rgba(15,23,42,.13)); }
.fc2-img { height:196px;background:#e2e8f0;overflow:hidden;position:relative; }
.fc2-img img { width:100%;height:100%;object-fit:cover;transition:transform .5s; }
.fc2-card:hover .fc2-img img { transform:scale(1.07); }
.fc2-img-ph { width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#0f172a,#1e293b); }
.fc2-badge-cat { position:absolute;top:12px;left:12px;background:rgba(6,187,204,.9);backdrop-filter:blur(4px);color:#fff;font-size:.68rem;font-weight:700;letter-spacing:.04em;padding:4px 11px;border-radius:50px;text-transform:uppercase; }
.fc2-badge-price { position:absolute;top:12px;right:12px;background:rgba(15,23,42,.85);backdrop-filter:blur(4px);color:#fff;font-size:.73rem;font-weight:700;padding:4px 11px;border-radius:50px; }
.fc2-badge-free { background:rgba(16,185,129,.9); }
.fc2-body { padding:20px;flex:1;display:flex;flex-direction:column; }
.fc2-level { font-size:.68rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;padding:3px 10px;border-radius:50px;display:inline-block;margin-bottom:9px; }
.fc2-lv-d { background:rgba(16,185,129,.1);color:#10b981; }
.fc2-lv-i { background:rgba(245,158,11,.1);color:#f59e0b; }
.fc2-lv-a { background:rgba(239,68,68,.1);color:#ef4444; }
.fc2-body h5 { font-family:'Poppins',sans-serif;font-weight:700;font-size:.96rem;color:var(--cfp-text,#0f172a);line-height:1.35;margin-bottom:8px; }
.fc2-desc { font-size:.82rem;color:var(--cfp-muted,#64748b);line-height:1.6;flex:1;margin-bottom:14px; }
.fc2-footer { display:flex;align-items:center;justify-content:space-between;padding:12px 20px;border-top:1px solid var(--cfp-border,rgba(0,0,0,.06));font-size:.76rem;color:var(--cfp-muted,#64748b);gap:6px;flex-wrap:wrap; }
.fc2-footer-item { display:flex;align-items:center;gap:5px; }
.fc2-footer-item i { color:#06BBCC; }
.fc2-btn { display:block;text-align:center;background:linear-gradient(135deg,#06BBCC,#0f766e);color:#fff;font-weight:700;font-size:.82rem;padding:10px 16px;text-decoration:none;transition:opacity .2s;margin:0 20px 18px;border-radius:10px; }
.fc2-btn:hover { opacity:.88;color:#fff; }

/* ═══════════════ ABOUT ═══════════════ */
.about-img-wrap { border-radius:20px;overflow:hidden;box-shadow:0 24px 60px var(--cfp-shadow-lg,rgba(15,23,42,.14));position:relative;height:460px; }
.about-img-wrap img { width:100%;height:100%;object-fit:cover;display:block; }
.about-overlay-badge { position:absolute;bottom:20px;left:20px;background:rgba(255,255,255,.96);backdrop-filter:blur(10px);border-radius:14px;padding:13px 17px;display:flex;align-items:center;gap:12px;box-shadow:0 8px 24px rgba(0,0,0,.1); }
.about-overlay-icon { width:40px;height:40px;border-radius:9px;background:linear-gradient(135deg,#06BBCC,#0f766e);display:flex;align-items:center;justify-content:center;flex-shrink:0; }
.about-feature { display:flex;align-items:center;gap:12px;padding:10px 14px;border-radius:10px;background:var(--cfp-bg2,#f8fafc);border:1px solid var(--cfp-border,rgba(0,0,0,.06));font-size:.875rem;font-weight:500;color:var(--cfp-text,#0f172a);transition:all .2s; }
.about-feature:hover { background:rgba(6,187,204,.06);border-color:rgba(6,187,204,.2); }
.about-feature-icon { width:30px;height:30px;flex-shrink:0;border-radius:7px;background:rgba(6,187,204,.12);color:#06BBCC;display:flex;align-items:center;justify-content:center;font-size:.8rem; }

/* ═══════════════ STEPS ═══════════════ */
.step-card { background:var(--cfp-card,#fff);border:1px solid var(--cfp-border,rgba(0,0,0,.06));border-radius:20px;padding:30px 22px;text-align:center;transition:all .3s;height:100%; }
.step-card:hover { transform:translateY(-5px);box-shadow:0 20px 50px var(--cfp-shadow-lg,rgba(15,23,42,.1)); }
.step-num { width:52px;height:52px;border-radius:50%;background:linear-gradient(135deg,#06BBCC,#0f766e);color:#fff;font-family:'Poppins',sans-serif;font-weight:800;font-size:1.2rem;display:flex;align-items:center;justify-content:center;margin:0 auto 18px;box-shadow:0 8px 20px rgba(6,187,204,.35); }
.step-card h5 { font-family:'Poppins',sans-serif;font-weight:700;color:var(--cfp-text,#0f172a);margin-bottom:9px;font-size:.96rem; }
.step-card p { font-size:.85rem;color:var(--cfp-muted,#64748b);line-height:1.65;margin:0; }

/* ═══════════════ FORMATEUR CARD ═══════════════ */
.fmt-card { background:var(--cfp-card,#fff);border:1px solid var(--cfp-border,rgba(0,0,0,.06));border-radius:20px;overflow:hidden;transition:all .3s;text-align:center;height:100%; }
.fmt-card:hover { transform:translateY(-6px);box-shadow:0 24px 50px var(--cfp-shadow-lg,rgba(15,23,42,.12)); }
.fmt-img { height:220px;overflow:hidden;position:relative; }
.fmt-img img { width:100%;height:100%;object-fit:cover;transition:transform .4s; }
.fmt-card:hover .fmt-img img { transform:scale(1.06); }
.fmt-placeholder { width:100%;height:100%;background:linear-gradient(135deg,#1e293b,#0f172a);display:flex;align-items:center;justify-content:center;font-family:'Poppins',sans-serif;font-weight:800;font-size:2.4rem;color:rgba(6,187,204,.6); }
.fmt-actions { position:absolute;bottom:0;left:0;right:0;background:linear-gradient(transparent,rgba(15,23,42,.8));padding:20px 14px 12px;display:flex;justify-content:center;gap:8px;opacity:0;transition:opacity .3s; }
.fmt-card:hover .fmt-actions { opacity:1; }
.fmt-action-btn { width:34px;height:34px;border-radius:50%;background:rgba(255,255,255,.14);backdrop-filter:blur(4px);border:1px solid rgba(255,255,255,.2);color:#fff;display:flex;align-items:center;justify-content:center;font-size:.8rem;text-decoration:none;transition:all .2s; }
.fmt-action-btn:hover { background:#06BBCC;border-color:#06BBCC;color:#fff; }
.fmt-body { padding:18px; }
.fmt-body h5 { font-family:'Poppins',sans-serif;font-weight:700;font-size:.93rem;color:var(--cfp-text,#0f172a);margin-bottom:4px; }
.fmt-domain { font-size:.76rem;color:#06BBCC;font-weight:600; }
.fmt-badge { display:inline-block;background:rgba(6,187,204,.1);color:#06BBCC;font-size:.68rem;font-weight:700;padding:3px 10px;border-radius:50px;margin-top:8px; }

/* ═══════════════ TESTIMONIALS ═══════════════ */
.testi-card { background:var(--cfp-card,#fff);border:1px solid var(--cfp-border,rgba(0,0,0,.06));border-radius:20px;padding:28px;height:100%;transition:all .3s; }
.testi-card:hover { transform:translateY(-4px);box-shadow:0 16px 40px var(--cfp-shadow-lg,rgba(15,23,42,.1)); }
.testi-stars { color:#f59e0b;font-size:.88rem;letter-spacing:2px;margin-bottom:13px; }
.testi-text { font-size:.88rem;color:var(--cfp-muted,#64748b);line-height:1.75;font-style:italic;margin-bottom:18px; }
.testi-author { display:flex;align-items:center;gap:12px; }
.testi-avatar { width:46px;height:46px;border-radius:50%;background:linear-gradient(135deg,#06BBCC,#0f766e);display:flex;align-items:center;justify-content:center;font-family:'Poppins',sans-serif;font-weight:800;font-size:.9rem;color:#fff;flex-shrink:0;border:2px solid rgba(6,187,204,.3); }
.testi-name { font-family:'Poppins',sans-serif;font-weight:700;font-size:.88rem;color:var(--cfp-text,#0f172a); }
.testi-job { font-size:.73rem;color:var(--cfp-muted,#64748b); }

/* ═══════════════ CTA FINAL ═══════════════ */
.cta-final { background:linear-gradient(135deg,#080d1a,#06292e,#080d1a);position:relative;overflow:hidden;padding:90px 0; }
.cta-final-g1 { position:absolute;width:500px;height:500px;background:radial-gradient(circle,rgba(6,187,204,.18) 0%,transparent 70%);top:-150px;left:-100px;pointer-events:none; }
.cta-final-g2 { position:absolute;width:400px;height:400px;background:radial-gradient(circle,rgba(15,118,110,.18) 0%,transparent 70%);bottom:-100px;right:0;pointer-events:none; }
.cta-final h2 { font-family:'Poppins',sans-serif;font-weight:800;font-size:clamp(1.8rem,4vw,2.8rem);color:#fff;line-height:1.2; }
.cta-final p { color:rgba(255,255,255,.56);font-size:.93rem;line-height:1.72;max-width:480px; }

/* ═══════════════ FAQ ═══════════════ */
.faq-item { background:var(--cfp-card,#fff);border:1px solid var(--cfp-border,rgba(0,0,0,.06));border-radius:14px;margin-bottom:10px;overflow:hidden;transition:border-color .2s; }
.faq-item.open { border-color:rgba(6,187,204,.35); }
.faq-question { width:100%;background:none;border:none;cursor:pointer;display:flex;align-items:center;justify-content:space-between;padding:17px 20px;gap:12px;font-family:'Poppins',sans-serif;font-weight:700;font-size:.9rem;color:var(--cfp-text,#0f172a);text-align:left;transition:color .2s; }
.faq-item.open .faq-question { color:#06BBCC; }
.faq-chevron { font-size:.72rem;transition:transform .3s;flex-shrink:0; }
.faq-item.open .faq-chevron { transform:rotate(180deg); }
.faq-answer { max-height:0;overflow:hidden;transition:max-height .35s ease,padding .15s;padding:0 20px;color:var(--cfp-muted,#64748b);font-size:.875rem;line-height:1.72; }
.faq-item.open .faq-answer { max-height:300px;padding:0 20px 18px;border-top:1px solid var(--cfp-border,rgba(0,0,0,.06));padding-top:13px; }

/* ═══ BORDS CARRÉS ═══ */
.why-card,.fc2-card,.step-card,.fmt-card,.testi-card,.faq-item,
.about-img-wrap,.dash-main,.dash-mod,.why-icon,
.about-feature,.about-feature-icon,.about-overlay-badge,.about-overlay-icon,
.float-cert,.float-live,.btn-hero-main,.btn-hero-ghost,.fc2-btn { border-radius:0!important; }
.sec-label,.hero-badge-v2,.fc2-badge-cat,.fc2-badge-price,.fc2-level,.fmt-badge,.dash-online,.float-students { border-radius:2px!important; }
.hero-dot-v2 { border-radius:2px!important; }

/* ═══ TRANSITIONS RAPIDES ═══ */
.why-card,.fc2-card,.step-card,.fmt-card,.testi-card { transition:all .12s ease!important; }
.btn-hero-main,.btn-hero-ghost,.fc2-btn,.about-feature,.fmt-action-btn { transition:all .12s ease!important; }
.faq-chevron { transition:transform .15s ease!important; }
.faq-answer { transition:max-height .18s ease,padding .08s!important; }
.fc2-img img,.fmt-img img { transition:transform .2s ease!important; }
.hero-dot-v2 { transition:all .15s ease!important; }
.hero-slide-text { transition:opacity .35s ease,transform .35s ease!important; }

/* ═══ SECTIONS PHOTO ALTERNÉES ═══ */
.ps-section { padding:80px 0; }
.ps-img-wrap { overflow:hidden;position:relative;height:460px; }
.ps-img-wrap img { width:100%;height:100%;object-fit:cover;transition:transform .2s ease;display:block; }
.ps-img-wrap:hover img { transform:scale(1.03); }
.ps-overlay { position:absolute;bottom:0;left:0;right:0;background:linear-gradient(transparent,rgba(8,13,26,.85));padding:36px 24px 22px;display:flex;align-items:center;gap:14px; }
.ps-overlay-icon { width:44px;height:44px;background:rgba(6,187,204,.9);display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.1rem;flex-shrink:0; }
.ps-overlay-text { color:#fff;font-family:'Poppins',sans-serif;font-weight:700;font-size:.92rem;line-height:1.35; }
.ps-overlay-sub { font-weight:400;font-size:.78rem;opacity:.75; }
.ps-feature { display:flex;align-items:flex-start;gap:14px;padding:15px 0;border-bottom:1px solid var(--cfp-border,rgba(0,0,0,.06)); }
.ps-feature:last-child { border-bottom:none; }
.ps-feature-icon { width:44px;height:44px;flex-shrink:0;background:rgba(6,187,204,.08);color:#06BBCC;display:flex;align-items:center;justify-content:center;font-size:1rem;border:1px solid rgba(6,187,204,.12); }
.ps-feature-title { font-family:'Poppins',sans-serif;font-weight:700;font-size:.9rem;color:var(--cfp-text,#0f172a);margin-bottom:3px; }
.ps-feature-desc { font-size:.83rem;color:var(--cfp-muted,#64748b);line-height:1.6;margin:0; }
[data-theme="dark"] .ps-feature { border-color:rgba(255,255,255,.06); }
[data-theme="dark"] .ps-feature-icon { background:rgba(6,187,204,.1);border-color:rgba(6,187,204,.2); }
@media(max-width:991px){ .ps-img-wrap { height:280px; } .ps-section { padding:50px 0; } }
@media(max-width:768px){
    .hero-v2 { min-height:68vh; padding:48px 0; }
    .hero-text-wrap { min-height:260px; }
    .hero-mini-stats { gap:14px; margin-top:22px; }
    .hero-stat-sep { display:none; }
}

/* ═══ CAROUSEL TÉMOIGNAGES INFINI ═══ */
.testi-carousel-wrap { overflow:hidden;padding:10px 0;position:relative; }
.testi-carousel-wrap::before,.testi-carousel-wrap::after { content:'';position:absolute;top:0;bottom:0;width:100px;z-index:2;pointer-events:none; }
.testi-carousel-wrap::before { left:0;background:linear-gradient(to right,var(--cfp-bg2,#f8fafc),transparent); }
.testi-carousel-wrap::after { right:0;background:linear-gradient(to left,var(--cfp-bg2,#f8fafc),transparent); }
.testi-track { display:flex;gap:20px;width:max-content;animation:testiScroll 38s linear infinite; }
.testi-track:hover { animation-play-state:paused; }
@keyframes testiScroll { 0%{transform:translateX(0)} 100%{transform:translateX(-50%)} }
.testi-card2 { width:340px;flex-shrink:0;background:var(--cfp-card,#fff);border:1px solid var(--cfp-border,rgba(0,0,0,.06));padding:24px;box-shadow:0 2px 14px rgba(0,0,0,.05); }
.testi-c2-stars { color:#f59e0b;font-size:1.05rem;letter-spacing:2px;margin-bottom:13px; }
.testi-c2-text { font-size:.875rem;color:var(--cfp-muted,#64748b);line-height:1.72;margin-bottom:18px;font-style:italic; }
.testi-c2-author { display:flex;align-items:center;gap:12px; }
.testi-c2-photo { width:46px;height:46px;flex-shrink:0;overflow:hidden;object-fit:cover;display:block; }
.testi-c2-name { font-family:'Poppins',sans-serif;font-weight:700;font-size:.9rem;color:var(--cfp-text,#0f172a); }
.testi-c2-job { font-size:.78rem;color:var(--cfp-muted,#64748b); }
[data-theme="dark"] .testi-card2 { background:var(--cfp-card,#1e293b);border-color:rgba(255,255,255,.07); }
[data-theme="dark"] .testi-carousel-wrap::before { background:linear-gradient(to right,var(--cfp-bg2,#0f172a),transparent); }
[data-theme="dark"] .testi-carousel-wrap::after { background:linear-gradient(to left,var(--cfp-bg2,#0f172a),transparent); }
</style>

<!-- ══════════════════════════════════════════════
     HERO
══════════════════════════════════════════════ -->
<section class="hero-v2" x-data="{
    current: 0,
    bgs: [
        '/assets_frontend/img/carousel-1.jpg',
        '/assets_frontend/img/carousel-2.jpg',
        '/assets_frontend/img/course-1.jpg',
        '/assets_frontend/img/about.jpg',
    ],
    slides: [
        {title: 'Construisez votre<br><span style=&quot;color:#22d3ee&quot;>avenir professionnel</span>', desc: 'Apprenez des compétences concrètes avec des formateurs experts à Goma. Votre réussite commence ici.', btn1_url: '{{ route('register') }}', btn1: 'Commencer maintenant', btn2_url: '{{ route('acceuil') }}', btn2: 'Voir les formations'},
        {title: 'Des formations pour<br><span style=&quot;color:#22d3ee&quot;>chaque ambition</span>', desc: 'Développement web, marketing, design, langues — trouvez la formation qui correspond à vos objectifs de carrière.', btn1_url: '{{ route('acceuil') }}', btn1: 'Explorer les formations', btn2_url: '{{ route('about') }}', btn2: 'Notre mission'},
        {title: 'Des formateurs<br><span style=&quot;color:#22d3ee&quot;>d\'exception</span>', desc: 'Nos experts passionnés vous guident pas à pas avec des méthodes pédagogiques innovantes adaptées au marché local.', btn1_url: '{{ route('register') }}', btn1: 'Rejoindre la communauté', btn2_url: '{{ route('contact') }}', btn2: 'Nous contacter'},
        {title: 'Certifications<br><span style=&quot;color:#22d3ee&quot;>reconnues</span>', desc: 'Obtenez des certifications valorisées par les employeurs et boostez votre employabilité dans toute la région.', btn1_url: '{{ route('register') }}', btn1: 'S\'inscrire maintenant', btn2_url: '{{ route('acceuil') }}', btn2: 'Voir le catalogue'},
    ],
    timer: null,
    init() { this.timer = setInterval(() => this.next(), 5500); },
    next() { this.current = (this.current + 1) % this.slides.length; },
    prev() { this.current = (this.current - 1 + this.slides.length) % this.slides.length; },
    go(i) { clearInterval(this.timer); this.current = i; this.timer = setInterval(() => this.next(), 5500); }
}">
    <!-- ── Photos de fond avec cross-fade ── -->
    <div class="hero-bg">
        <template x-for="(bg, i) in bgs" :key="'bg'+i">
            <div class="hero-bg-slide"
                 :class="{'hbs-active': current === i}"
                 :style="'background-image:url('+bg+')'">
            </div>
        </template>
    </div>
    <div class="hero-overlay"></div>

    <div class="container py-5" style="position:relative;z-index:2;">
        <div class="row">
            <div class="col-lg-8 col-xl-6">

                <div class="hero-badge-v2">
                    <span class="hero-pulse"></span>
                    Inscriptions ouvertes 2026
                </div>

                <div class="hero-text-wrap mb-4">
                    <template x-for="(s, i) in slides" :key="i">
                        <div class="hero-slide-text" :class="{'hs-active': current === i}">
                            <h1 style="font-family:'Poppins',sans-serif;font-weight:800;font-size:clamp(2rem,4.5vw,3.2rem);color:#fff;line-height:1.18;margin-bottom:18px;" x-html="s.title"></h1>
                            <p style="font-size:1rem;color:rgba(255,255,255,.65);line-height:1.75;max-width:520px;" x-text="s.desc"></p>
                        </div>
                    </template>
                </div>

                <!-- CTAs -->
                <template x-for="(s, i) in slides" :key="'cta'+i">
                    <div x-show="current === i">
                        <div class="hero-cta-wrap d-flex gap-3 flex-wrap mb-5">
                            <a :href="s.btn1_url" class="btn-hero-main">
                                <i class="bi bi-lightning-fill"></i><span x-text="s.btn1"></span>
                            </a>
                            <a :href="s.btn2_url" class="btn-hero-ghost">
                                <span x-text="s.btn2"></span><i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </template>

                <!-- Dots -->
                <div class="hero-dots-v2">
                    <template x-for="(s, i) in slides" :key="'dot'+i">
                        <button class="hero-dot-v2" :class="{'hd-active': current === i}" @click="go(i)"></button>
                    </template>
                </div>

            </div>
        </div>
    </div>
    <!-- Arrows -->
    <button @click="prev()" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);z-index:5;width:42px;height:42px;border-radius:50%;background:rgba(255,255,255,.07);border:1.5px solid rgba(255,255,255,.16);color:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .2s;backdrop-filter:blur(6px);" onmouseover="this.style.background='rgba(6,187,204,.5)'" onmouseout="this.style.background='rgba(255,255,255,.07)'">
        <i class="bi bi-chevron-left"></i>
    </button>
    <button @click="next()" style="position:absolute;right:14px;top:50%;transform:translateY(-50%);z-index:5;width:42px;height:42px;border-radius:50%;background:rgba(255,255,255,.07);border:1.5px solid rgba(255,255,255,.16);color:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .2s;backdrop-filter:blur(6px);" onmouseover="this.style.background='rgba(6,187,204,.5)'" onmouseout="this.style.background='rgba(255,255,255,.07)'">
        <i class="bi bi-chevron-right"></i>
    </button>
</section>


<!-- ══════════ POURQUOI NOUS ══════════ -->
<section class="sec-bg" style="padding:90px 0;">
    <div class="container">
        <div class="text-center mb-5">
            <div class="sec-label"><i class="bi bi-stars"></i> Nos avantages</div>
            <h2 class="sec-title">Pourquoi choisir <span style="color:#06BBCC;">CFP Mon Cœur ?</span></h2>
            <p class="sec-sub mx-auto mt-3">Une pédagogie centrée sur la pratique, des formateurs engagés et un suivi personnalisé pour chaque étudiant.</p>
        </div>
        <div class="row g-4">
            @php $whys = [
                ['icon'=>'bi-person-workspace','title'=>"Formateurs d'Exception",'desc'=>'Nos formateurs sont des professionnels certifiés avec une expérience terrain. Ils vous transmettent leur savoir-faire de façon concrète.'],
                ['icon'=>'bi-patch-check-fill','title'=>'Certifications Reconnues','desc'=>'Obtenez des certifications valorisées par les employeurs de la région et boostez votre employabilité.'],
                ['icon'=>'bi-tools','title'=>'Projets Concrets','desc'=>'Apprenez en faisant : chaque formation intègre des projets réels adaptés au marché local congolais.'],
                ['icon'=>'bi-heart-pulse-fill','title'=>'Accompagnement Humain','desc'=>"Notre équipe est disponible à chaque étape. Vous n'êtes jamais seul dans votre apprentissage."],
                ['icon'=>'bi-phone-fill','title'=>'Formation Flexible','desc'=>"Accédez aux ressources depuis n'importe où. Formations présentielles et à distance disponibles."],
                ['icon'=>'bi-trophy-fill','title'=>'Résultats Prouvés','desc'=>'98% de satisfaction. Nos diplômés sont recherchés par les meilleures entreprises de la région.'],
                ['icon'=>'bi-cash-coin','title'=>'Prix Accessibles','desc'=>'Des formations de qualité à des tarifs adaptés au marché local avec des options de paiement échelonné.'],
                ['icon'=>'bi-people-fill','title'=>'Communauté Active','desc'=>"Rejoignez plus de 500 anciens étudiants qui se soutiennent et créent des opportunités ensemble."],
            ]; @endphp
            @foreach($whys as $w)
            <div class="col-lg-3 col-sm-6">
                <div class="why-card">
                    <div class="why-icon"><i class="bi {{ $w['icon'] }}"></i></div>
                    <h5>{{ $w['title'] }}</h5>
                    <p>{{ $w['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ══════════ FORMATIONS ══════════ -->
<section class="sec-bg-alt" style="padding:90px 0;">
    <div class="container">
        <div class="d-flex align-items-end justify-content-between mb-5 flex-wrap gap-3">
            <div>
                <div class="sec-label"><i class="bi bi-mortarboard-fill"></i> Catalogue</div>
                <h2 class="sec-title mt-2">Nos formations <span style="color:#06BBCC;">populaires</span></h2>
            </div>
            <a href="{{ route('nos-formations') }}" class="btn btn-outline-primary" style="border-radius:10px;font-weight:700;font-size:.875rem;padding:10px 22px;white-space:nowrap;">
                Toutes les formations <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
        @if(isset($cours) && $cours->count() > 0)
        <div class="row g-4">
            @foreach($cours as $f)
            <div class="col-lg-4 col-md-6">
                <div class="fc2-card">
                    <div class="fc2-img">
                        @if($f->photo && \Storage::exists('public/'.$f->photo))
                            <img src="{{ asset('storage/'.$f->photo) }}" alt="{{ $f->titre }}">
                        @else
                            <div class="fc2-img-ph"><i class="bi bi-mortarboard-fill" style="font-size:3rem;color:rgba(6,187,204,.4);"></i></div>
                        @endif
                        @if($f->categorie)<span class="fc2-badge-cat">{{ $f->categorie }}</span>@endif
                        <span class="fc2-badge-price {{ (!$f->prix || $f->prix==0) ? 'fc2-badge-free' : '' }}">
                            {{ (!$f->prix || $f->prix==0) ? 'Gratuit' : number_format($f->prix,0,',',' ').' FC' }}
                        </span>
                    </div>
                    <div class="fc2-body">
                        @if($f->niveau)
                        @php $lvl = match($f->niveau){'Débutant'=>'d','Intermédiaire'=>'i',default=>'a'}; @endphp
                        <span class="fc2-level fc2-lv-{{ $lvl }}">{{ $f->niveau }}</span>
                        @endif
                        <h5>{{ $f->titre }}</h5>
                        <p class="fc2-desc">{{ Str::limit($f->description, 90) }}</p>
                    </div>
                    <div class="fc2-footer">
                        @if($f->formateur)<span class="fc2-footer-item"><i class="bi bi-person-fill"></i>{{ $f->formateur->prenom }} {{ $f->formateur->nom }}</span>@endif
                        @if($f->duree)<span class="fc2-footer-item"><i class="bi bi-clock-fill"></i>{{ $f->duree }}</span>@endif
                    </div>
                    <a href="{{ route('formation.detail', $f->id) }}" class="fc2-btn">
                        Voir les détails <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-mortarboard" style="font-size:4rem;color:rgba(6,187,204,.25);"></i>
            <p class="mt-3 sec-sub">Aucune formation disponible pour le moment.</p>
        </div>
        @endif
    </div>
</section>

<!-- ══════════ PHOTO SECTION 1 — texte gauche, photo droite ══════════ -->
<section class="sec-bg ps-section">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="sec-label"><i class="bi bi-laptop-fill"></i> Formation pratique</div>
                <h2 class="sec-title mt-2 mb-4">Apprenez en faisant,<br><span style="color:#06BBCC;">pas seulement en écoutant</span></h2>
                <p style="color:var(--cfp-muted,#64748b);font-size:.93rem;line-height:1.8;margin-bottom:24px;">Chaque cours est construit autour de projets réels. Vous construisez votre portfolio dès le premier jour et quittez la formation avec des réalisations concrètes à montrer aux employeurs de Goma.</p>
                <div>
                    @php $psF1 = [
                        ['icon'=>'bi-code-square','title'=>'Projets concrets','desc'=>'Développez des applications que vous pouvez présenter directement aux employeurs.'],
                        ['icon'=>'bi-camera-video-fill','title'=>'Sessions enregistrées','desc'=>'Revoyez les cours à votre rythme, autant de fois que vous en avez besoin.'],
                        ['icon'=>'bi-people-fill','title'=>'Ateliers collaboratifs','desc'=>"Travaillez en équipe sur des défis réels du marché local congolais."],
                    ]; @endphp
                    @foreach($psF1 as $pf)
                    <div class="ps-feature">
                        <div class="ps-feature-icon"><i class="bi {{ $pf['icon'] }}"></i></div>
                        <div>
                            <div class="ps-feature-title">{{ $pf['title'] }}</div>
                            <p class="ps-feature-desc">{{ $pf['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('nos-formations') }}" class="btn btn-primary mt-4 d-inline-flex align-items-center gap-2" style="border-radius:0;font-weight:700;font-size:.9rem;padding:12px 28px;background:linear-gradient(135deg,#06BBCC,#0f766e);border:none;">
                    <i class="bi bi-arrow-right"></i>Voir nos formations
                </a>
            </div>
            <div class="col-lg-6 order-1 order-lg-2">
                <div class="ps-img-wrap">
                    <img src="{{ asset('assets_frontend/img/course-2.jpg') }}" alt="Étudiants en formation">
                    <div class="ps-overlay">
                        <div class="ps-overlay-icon"><i class="bi bi-mortarboard-fill"></i></div>
                        <div class="ps-overlay-text">+500 projets réalisés<br><span class="ps-overlay-sub">par nos étudiants cette année</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════ À PROPOS ══════════ -->
<section class="sec-bg" style="padding:90px 0;">
    <div class="container">
        <div class="row g-5 align-items-center">
            <!-- Image — toujours visible, pas de position:absolute -->
            <div class="col-lg-6">
                <div class="about-img-wrap">
                    <img src="{{ asset('assets_frontend/img/about.jpg') }}"
                         alt="À propos de CFP MON CŒUR"
                         onerror="this.src='https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=800&q=80&auto=format'">
                    <div class="about-overlay-badge">
                        <div class="about-overlay-icon">
                            <i class="bi bi-heart-fill text-white" style="font-size:1rem;"></i>
                        </div>
                        <div>
                            <div style="font-family:'Poppins',sans-serif;font-weight:800;font-size:.87rem;color:#0f172a;line-height:1.1;">Centre de confiance</div>
                            <div style="font-size:.7rem;color:#64748b;">Goma, RDC — depuis 2020</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Text -->
            <div class="col-lg-6">
                <div class="sec-label"><i class="bi bi-info-circle-fill"></i> À propos de nous</div>
                <h2 class="sec-title mt-2 mb-3">
                    CFP MON CŒUR —<br>votre partenaire de<br><span style="color:#06BBCC;">réussite professionnelle</span>
                </h2>
                <p style="color:var(--cfp-muted,#64748b);line-height:1.8;font-size:.93rem;margin-bottom:12px;">
                    Nous transformons les talents en compétences utiles à travers des actions concrètes, orientées vers les besoins réels du marché congolais. Chaque étudiant est accompagné avec bienveillance.
                </p>
                <p style="color:var(--cfp-muted,#64748b);line-height:1.8;font-size:.93rem;margin-bottom:28px;">
                    CFP MON CŒUR contribue à l'emploi, l'autonomie et le développement durable des jeunes et professionnels de Goma et au-delà, avec une vision résolument tournée vers l'avenir numérique africain.
                </p>
                <div class="row g-2 mb-4">
                    @php $features = [
                        ['icon'=>'bi-person-badge-fill','text'=>'Formateurs qualifiés et certifiés'],
                        ['icon'=>'bi-patch-check-fill','text'=>'Certificats reconnus professionnellement'],
                        ['icon'=>'bi-hand-thumbs-up-fill','text'=>'Encadrement pratique et bienveillant'],
                        ['icon'=>'bi-geo-alt-fill','text'=>'Formations adaptées au marché local'],
                    ]; @endphp
                    @foreach($features as $feat)
                    <div class="col-12">
                        <div class="about-feature">
                            <div class="about-feature-icon"><i class="bi {{ $feat['icon'] }}"></i></div>
                            {{ $feat['text'] }}
                        </div>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('about') }}" class="btn btn-primary" style="border-radius:10px;font-weight:700;font-size:.9rem;padding:12px 28px;background:linear-gradient(135deg,#06BBCC,#0f766e);border:none;box-shadow:0 6px 20px rgba(6,187,204,.28);">
                    <i class="bi bi-arrow-right me-2"></i>En savoir plus
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ══════════ COMMENT ÇA MARCHE ══════════ -->
<section class="sec-bg-alt" style="padding:90px 0;">
    <div class="container">
        <div class="text-center mb-5">
            <div class="sec-label"><i class="bi bi-diagram-3-fill"></i> Processus</div>
            <h2 class="sec-title mt-2">Comment ça <span style="color:#06BBCC;">fonctionne ?</span></h2>
            <p class="sec-sub mx-auto mt-3">En 4 étapes simples, commencez votre parcours et obtenez votre certification.</p>
        </div>
        <div class="row g-4">
            @php $steps = [
                ['n'=>'1','icon'=>'bi-person-plus-fill','title'=>'Créez votre compte','desc'=>"Inscrivez-vous gratuitement en quelques clics. Complétez votre profil et choisissez vos préférences d'apprentissage."],
                ['n'=>'2','icon'=>'bi-search','title'=>'Choisissez une formation','desc'=>"Parcourez notre catalogue et trouvez la formation qui correspond à vos objectifs professionnels et votre niveau actuel."],
                ['n'=>'3','icon'=>'bi-play-circle-fill','title'=>'Apprenez à votre rythme','desc'=>"Suivez les cours avec l'accompagnement de formateurs experts. Pratiquez avec des projets réels et concrets."],
                ['n'=>'4','icon'=>'bi-award-fill','title'=>'Obtenez votre certificat','desc'=>"Après validation, recevez votre certificat reconnu. Accédez à notre réseau d'employeurs partenaires."],
            ]; @endphp
            @foreach($steps as $i => $s)
            <div class="col-lg-3 col-sm-6">
                <div class="step-card">
                    <div class="step-num">{{ $s['n'] }}</div>
                    <i class="bi {{ $s['icon'] }}" style="font-size:1.6rem;color:rgba(6,187,204,.35);margin-bottom:12px;display:block;"></i>
                    <h5>{{ $s['title'] }}</h5>
                    <p>{{ $s['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ══════════ PHOTO SECTION 2 — photo gauche, texte droite ══════════ -->
<section class="sec-bg-alt ps-section">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="ps-img-wrap">
                    <img src="{{ asset('assets_frontend/img/carousel-1.jpg') }}" alt="Campus CFP Mon Coeur">
                    <div class="ps-overlay">
                        <div class="ps-overlay-icon"><i class="bi bi-geo-alt-fill"></i></div>
                        <div class="ps-overlay-text">Campus de Goma, RDC<br><span class="ps-overlay-sub">Quartier Himbi — ouvert 6j/7</span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="sec-label"><i class="bi bi-building-fill"></i> Notre environnement</div>
                <h2 class="sec-title mt-2 mb-4">Un cadre moderne<br><span style="color:#06BBCC;">au cœur de Goma</span></h2>
                <p style="color:var(--cfp-muted,#64748b);font-size:.93rem;line-height:1.8;margin-bottom:24px;">CFP Mon Cœur est équipé de salles modernes, d'un accès internet haut débit et de tous les outils nécessaires pour apprendre dans les meilleures conditions possibles.</p>
                <div>
                    @php $psF2 = [
                        ['icon'=>'bi-wifi','title'=>'Connexion haut débit','desc'=>'Accès internet fiable pour toutes les sessions pratiques et exercices en ligne.'],
                        ['icon'=>'bi-display-fill','title'=>'Équipements modernes','desc'=>"Ordinateurs, vidéoprojecteurs et outils pédagogiques de dernière génération."],
                        ['icon'=>'bi-shield-check-fill','title'=>'Environnement sécurisé','desc'=>'Un cadre serein et sécurisé pour vous concentrer pleinement sur votre apprentissage.'],
                    ]; @endphp
                    @foreach($psF2 as $pf)
                    <div class="ps-feature">
                        <div class="ps-feature-icon"><i class="bi {{ $pf['icon'] }}"></i></div>
                        <div>
                            <div class="ps-feature-title">{{ $pf['title'] }}</div>
                            <p class="ps-feature-desc">{{ $pf['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('contact') }}" class="btn btn-outline-primary mt-4 d-inline-flex align-items-center gap-2" style="border-radius:0;font-weight:700;font-size:.9rem;padding:12px 28px;">
                    <i class="bi bi-map-fill"></i>Nous trouver
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ══════════ FORMATEURS ══════════ -->
<section class="sec-bg" style="padding:90px 0;">
    <div class="container">
        <div class="text-center mb-5">
            <div class="sec-label"><i class="bi bi-people-fill"></i> Nos experts</div>
            <h2 class="sec-title mt-2">Formateurs <span style="color:#06BBCC;">d'exception</span></h2>
            <p class="sec-sub mx-auto mt-3">Des professionnels passionnés qui transmettent leur expertise avec bienveillance.</p>
        </div>
        @if(isset($formateurs) && $formateurs->count() > 0)
        <div class="row g-4 justify-content-center">
            @foreach($formateurs->take(4) as $fmt)
            <div class="col-lg-3 col-md-6">
                <div class="fmt-card">
                    <div class="fmt-img">
                        @if($fmt->photo && file_exists(storage_path('app/public/'.$fmt->photo)))
                            <img src="{{ asset('storage/'.$fmt->photo) }}" alt="{{ $fmt->prenom }} {{ $fmt->nom }}">
                        @else
                            <div class="fmt-placeholder">{{ strtoupper(substr($fmt->prenom,0,1).substr($fmt->nom,0,1)) }}</div>
                        @endif
                        <div class="fmt-actions">
                            @if($fmt->email)<a href="mailto:{{ $fmt->email }}" class="fmt-action-btn"><i class="bi bi-envelope-fill"></i></a>@endif
                            <a href="#" class="fmt-action-btn"><i class="bi bi-person-fill"></i></a>
                        </div>
                    </div>
                    <div class="fmt-body">
                        <h5>{{ $fmt->prenom }} {{ $fmt->nom }}</h5>
                        <div class="fmt-domain">{{ $fmt->domaine ?? 'Formateur' }}</div>
                        <span class="fmt-badge">Expert certifié</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('about') }}" class="btn btn-primary" style="border-radius:10px;font-weight:700;padding:12px 28px;background:linear-gradient(135deg,#06BBCC,#0f766e);border:none;">
                <i class="bi bi-people-fill me-2"></i>Voir tous nos formateurs
            </a>
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-person-workspace" style="font-size:4rem;color:rgba(6,187,204,.25);"></i>
            <p class="mt-3 sec-sub">Nos formateurs experts rejoignent bientôt l'équipe.</p>
        </div>
        @endif
    </div>
</section>

<!-- ══════════ TÉMOIGNAGES ══════════ -->
<section class="sec-bg-alt" style="padding:90px 0;">
    <div class="container">
        <div class="text-center mb-5">
            <div class="sec-label"><i class="bi bi-chat-quote-fill"></i> Témoignages</div>
            <h2 class="sec-title mt-2">Ce que disent <span style="color:#06BBCC;">nos étudiants</span></h2>
            <p class="sec-sub mx-auto mt-3">Des parcours réels, des vies transformées. Lisez leurs histoires.</p>
        </div>
        @php $testimonials = [
            ['i'=>'MK','name'=>'Marie K.','job'=>'Développeuse Web','stars'=>5,'text'=>"Grâce aux formations de CFP MON CŒUR, j'ai acquis des compétences pratiques qui m'ont permis de décrocher un emploi rapidement. Un centre vraiment à l'écoute !"],
            ['i'=>'SM','name'=>'Sophie M.','job'=>'Chef de Projet','stars'=>5,'text'=>"L'encadrement est exceptionnel. Les formateurs sont disponibles, patients et très qualifiés. Je recommande vivement CFP Mon Cœur à tous."],
            ['i'=>'PT','name'=>'Paul T.','job'=>'Marketing Digital','stars'=>5,'text'=>"Une formation de qualité professionnelle qui m'a permis de lancer ma propre activité. Le meilleur investissement que j'ai fait pour ma carrière."],
            ['i'=>'AC','name'=>'Amina C.','job'=>'Designer UI/UX','stars'=>5,'text'=>"La pédagogie est excellente, les projets pratiques m'ont vraiment préparée au marché du travail. Je suis aujourd'hui responsable design."],
            ['i'=>'JB','name'=>'Jean-Baptiste N.','job'=>'Entrepreneur','stars'=>5,'text'=>"J'ai créé mon entreprise après ma formation en Business & Gestion. CFP Mon Cœur m'a donné les outils et la confiance pour entreprendre."],
            ['i'=>'GF','name'=>'Gloria F.','job'=>'Comptable','stars'=>5,'text'=>"Formation très structurée et pratique. Les formateurs connaissent vraiment le marché local. Je recommande à 100%."],
        ]; @endphp
        <div class="row g-4">
            @foreach($testimonials as $t)
            <div class="col-lg-4 col-md-6">
                <div class="testi-card">
                    <div class="testi-stars">{{ str_repeat('★', $t['stars']) }}</div>
                    <p class="testi-text">"{{ $t['text'] }}"</p>
                    <div class="testi-author">
                        <div class="testi-avatar">{{ $t['i'] }}</div>
                        <div>
                            <div class="testi-name">{{ $t['name'] }}</div>
                            <div class="testi-job">{{ $t['job'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ══════════ CTA FINAL ══════════ -->
<section class="cta-final">
    <div class="cta-final-g1"></div>
    <div class="cta-final-g2"></div>
    <div class="container" style="position:relative;z-index:2;">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(6,187,204,.12);border:1px solid rgba(6,187,204,.25);border-radius:50px;padding:6px 16px;margin-bottom:20px;">
                    <span style="width:7px;height:7px;border-radius:50%;background:#22d3ee;animation:hpulse 1.8s ease-out infinite;flex-shrink:0;"></span>
                    <span style="font-size:.72rem;font-weight:700;letter-spacing:.08em;color:#22d3ee;text-transform:uppercase;">Inscriptions ouvertes</span>
                </div>
                <h2>Prêt à transformer<br>votre avenir professionnel ?</h2>
                <p class="mt-3">Rejoignez plus de 500 étudiants qui ont fait confiance à CFP Mon Cœur pour construire leur carrière. La formation qui change une vie commence maintenant.</p>
            </div>
            <div class="col-lg-5">
                <div class="d-flex flex-column gap-3">
                    @guest
                    <a href="{{ route('register') }}" class="btn-hero-main justify-content-center" style="text-decoration:none;">
                        <i class="bi bi-lightning-fill"></i> S'inscrire gratuitement
                    </a>
                    @endguest
                    @auth
                    <a href="{{ route('dashboard') }}" class="btn-hero-main justify-content-center" style="text-decoration:none;">
                        <i class="bi bi-grid-1x2-fill"></i> Mon tableau de bord
                    </a>
                    @endauth
                    <a href="{{ route('nos-formations') }}" class="btn-hero-ghost justify-content-center" style="text-decoration:none;">
                        <i class="bi bi-search"></i> Voir toutes les formations
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════ FAQ ══════════ -->
<section class="sec-bg" style="padding:90px 0;">
    <div class="container">
        <div class="row g-5 align-items-start">
            <div class="col-lg-5">
                <div class="sec-label"><i class="bi bi-question-circle-fill"></i> FAQ</div>
                <h2 class="sec-title mt-2">Questions <span style="color:#06BBCC;">fréquentes</span></h2>
                <p class="sec-sub mt-3">Vous avez une question ? Consultez nos réponses ou contactez-nous directement.</p>
                <a href="{{ route('contact') }}" class="btn btn-outline-primary mt-4" style="border-radius:10px;font-weight:700;padding:11px 24px;display:inline-flex;align-items:center;gap:8px;">
                    <i class="bi bi-chat-dots-fill"></i>Nous contacter
                </a>
            </div>
            <div class="col-lg-7">
                @php $faqs = [
                    ['q'=>"Comment s'inscrire à une formation ?", 'a'=>"Créez un compte sur notre plateforme, parcourez notre catalogue et cliquez sur 'S'inscrire' pour la formation choisie. Notre équipe vous contactera dans les 24h pour finaliser votre inscription."],
                    ['q'=>'Quels sont les modes de paiement acceptés ?', 'a'=>'Nous acceptons le paiement en espèces, Mobile Money (M-Pesa, Airtel Money) et le virement bancaire. Des facilités de paiement en plusieurs tranches sont disponibles sur demande.'],
                    ['q'=>'Les certificats sont-ils reconnus ?', 'a'=>'Oui, nos certificats sont reconnus par les entreprises partenaires de la région et attestent de compétences pratiques vérifiables. Ils sont signés par nos formateurs certifiés.'],
                    ['q'=>'Peut-on suivre les formations en ligne ?', 'a'=>"Certaines formations proposent un format hybride (présentiel + en ligne). Contactez-nous pour connaître les options disponibles pour la formation qui vous intéresse."],
                    ['q'=>'Quelle est la durée des formations ?', 'a'=>'La durée varie selon les formations : de 1 à 6 mois. Chaque fiche formation indique la durée totale et les horaires hebdomadaires prévus.'],
                    ['q'=>'Y a-t-il un suivi après la formation ?', 'a'=>"Oui ! Nos diplômés bénéficient d'un accès à notre réseau d'employeurs partenaires, d'un accompagnement à la recherche d'emploi et d'une communauté d'anciens étudiants très active."],
                ]; @endphp
                @foreach($faqs as $i => $f)
                <div class="faq-item" id="faq{{ $i }}">
                    <button class="faq-question" type="button" data-index="{{ $i }}">
                        {{ $f['q'] }}<i class="bi bi-chevron-down faq-chevron"></i>
                    </button>
                    <div class="faq-answer">{{ $f['a'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<script>
function cfpFaqToggle(i) {
    var item = document.getElementById('faq'+i);
    var isOpen = item.classList.contains('open');
    document.querySelectorAll('.faq-item').forEach(function(el){ el.classList.remove('open'); });
    if (!isOpen) item.classList.add('open');
}
// attach click handlers without inline Blade in attributes
document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('.faq-question').forEach(function(btn){
        btn.addEventListener('click', function(){
            var i = this.dataset.index;
            cfpFaqToggle(i);
        });
    });
});
</script>
</div>
