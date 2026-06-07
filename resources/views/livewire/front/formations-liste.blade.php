<div>
<script>
function heroFormations() {
    return {
        current: 0,
        slides: 3,
        timer: null,
        init() { this.timer = setInterval(() => { this.current = (this.current + 1) % this.slides; }, 4000); },
    };
}
</script>
<style>
.fl-hero { background: linear-gradient(135deg, #181d38 0%, #0f1628 60%, #1a1060 100%); padding: 80px 0 50px; position: relative; overflow: hidden; }
.fl-hero-orb { position:absolute; border-radius:50%; background:rgba(6,187,204,.06); animation:flOrb 8s ease-in-out infinite; }
@keyframes flOrb { 0%,100%{transform:scale(1) translate(0,0)} 50%{transform:scale(1.12) translate(-20px,15px)} }
.fl-search-wrap { position:relative; max-width:600px; margin:0 auto; }
.fl-search-wrap i { position:absolute; left:20px; top:50%; transform:translateY(-50%); color:#06BBCC; font-size:1.1rem; pointer-events:none; }
.fl-search-input { width:100%; padding:16px 24px 16px 52px; border-radius:50px; border:none; font-size:.95rem; outline:none; box-shadow:0 8px 40px rgba(0,0,0,.25); font-family:'Nunito',sans-serif; }
.fl-filter-bar { background:#fff; border-bottom:1px solid #e8edf5; padding:14px 0; position:sticky; top:0; z-index:50; box-shadow:0 2px 16px rgba(0,0,0,.07); }
.fl-select { border:1.5px solid #e8edf5; border-radius:50px; padding:9px 20px; font-size:.84rem; font-weight:700; outline:none; cursor:pointer; background:#f8fafc; color:#374151; font-family:'Nunito',sans-serif; transition:border-color .2s; }
.fl-select:focus { border-color:#06BBCC; }
.fl-card { background:#fff; border-radius:20px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,.07); border:1px solid #e8edf5; transition:transform .2s, box-shadow .2s; height:100%; display:flex; flex-direction:column; }
.fl-card:hover { transform:translateY(-6px); box-shadow:0 16px 48px rgba(0,0,0,.13); }
.fl-card-img { height:220px; overflow:hidden; position:relative; flex-shrink:0; }
.fl-card-img img { width:100%; height:100%; object-fit:cover; transition:transform .4s ease; }
.fl-card:hover .fl-card-img img { transform:scale(1.06); }
.fl-card-placeholder { width:100%; height:100%; background:linear-gradient(135deg,#181d38,#0f1628); display:flex; align-items:center; justify-content:center; }
.fl-badge { border-radius:50px; padding:4px 12px; font-size:.72rem; font-weight:800; display:inline-block; }
.fl-badge-cat { background:rgba(6,187,204,.9); color:#fff; }
.fl-badge-price { background:rgba(0,0,0,.65); color:#fff; }
.fl-badge-level-deb { background:#eff6ff; color:#1d4ed8; }
.fl-badge-level-int { background:#fef3c7; color:#92400e; }
.fl-badge-level-adv { background:#fdf4ff; color:#7c3aed; }
.fl-card-body { padding:20px; flex:1; display:flex; flex-direction:column; }
.fl-card-title { font-family:'Nunito',sans-serif; font-weight:800; color:#0f172a; font-size:1rem; line-height:1.35; margin-bottom:8px; }
.fl-card-desc { color:#64748b; font-size:.84rem; line-height:1.6; margin-bottom:14px; flex:1; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
.fl-meta { display:flex; gap:12px; flex-wrap:wrap; margin-bottom:16px; }
.fl-meta span { color:#64748b; font-size:.78rem; display:flex; align-items:center; gap:4px; }
.fl-meta i { color:#06BBCC; }
.fl-cta { display:block; background:linear-gradient(135deg,#06BBCC,#059aaa); color:#fff; border-radius:12px; padding:12px; text-align:center; font-family:'Nunito',sans-serif; font-weight:800; font-size:.875rem; text-decoration:none; transition:opacity .15s; margin-top:auto; }
.fl-cta:hover { opacity:.88; color:#fff; }
.fl-empty { text-align:center; padding:80px 20px; }
.fl-empty-icon { width:80px; height:80px; background:#f1f5f9; border-radius:24px; display:flex; align-items:center; justify-content:center; margin:0 auto 20px; }
</style>

<!-- ── Hero ── -->
<div class="fl-hero">
    <div class="fl-hero-orb" style="width:500px;height:500px;top:-150px;right:-120px;"></div>
    <div class="fl-hero-orb" style="width:300px;height:300px;bottom:-100px;left:-80px;animation-delay:3s;"></div>
    <div class="container" style="position:relative;z-index:1;">
        <div class="text-center">
            <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(6,187,204,.12);border:1px solid rgba(6,187,204,.25);border-radius:50px;padding:6px 18px;margin-bottom:20px;">
                <span style="width:7px;height:7px;background:#06BBCC;border-radius:50%;animation:pulse 1.5s infinite;"></span>
                <span style="color:#06BBCC;font-size:.8rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;">Inscriptions ouvertes</span>
            </div>
            <h1 style="color:#fff;font-family:'Nunito',sans-serif;font-weight:800;font-size:clamp(2rem,5vw,3.2rem);line-height:1.15;margin-bottom:16px;">
                Nos Formations
            </h1>
            <p style="color:rgba(255,255,255,.7);font-size:1.05rem;max-width:560px;margin:0 auto 36px;line-height:1.75;">
                Découvrez nos formations professionnelles et trouvez celle qui correspond à vos objectifs de carrière.
            </p>
            <!-- Search -->
            <div class="fl-search-wrap">
                <i class="fa fa-search"></i>
                <input wire:model.live.debounce.400ms="search"
                       type="text"
                       placeholder="Rechercher une formation, une compétence..."
                       class="fl-search-input">
            </div>
        </div>
    </div>
</div>

<!-- ── Filter Bar ── -->
<div class="fl-filter-bar">
    <div class="container">
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <select wire:model.live="categorie" class="fl-select">
                <option value="">Toutes les catégories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}">{{ $cat }}</option>
                @endforeach
            </select>
            <select wire:model.live="niveau" class="fl-select">
                <option value="">Tous les niveaux</option>
                @foreach($niveaux as $niv)
                    <option value="{{ $niv }}">{{ $niv }}</option>
                @endforeach
            </select>
            @if($search || $categorie || $niveau)
                <button wire:click="$set('search','');$set('categorie','');$set('niveau','')"
                        style="border:none;background:rgba(239,68,68,.1);color:#ef4444;border-radius:50px;padding:9px 18px;font-size:.82rem;font-weight:700;cursor:pointer;">
                    <i class="fa fa-times me-1"></i>Réinitialiser
                </button>
            @endif
            <span style="margin-left:auto;color:#94a3b8;font-size:.84rem;font-weight:600;">
                <i class="fa fa-graduation-cap me-1" style="color:#06BBCC;"></i>
                {{ $formations->total() }} formation{{ $formations->total() > 1 ? 's' : '' }}
            </span>
        </div>
    </div>
</div>

<!-- ── Grid ── -->
<div style="background:#f4f7fb;min-height:60vh;">
    <div class="container-xxl py-5">
        <div class="container">
            @if($formations->isEmpty())
                <div class="fl-empty">
                    <div class="fl-empty-icon">
                        <i class="fa fa-search" style="font-size:2rem;color:#94a3b8;"></i>
                    </div>
                    <h5 style="color:#0f172a;font-weight:800;margin-bottom:8px;">Aucune formation trouvée</h5>
                    <p style="color:#94a3b8;margin-bottom:20px;">Essayez de modifier vos critères de recherche ou réinitialisez les filtres.</p>
                    <button wire:click="$set('search','');$set('categorie','');$set('niveau','')"
                            style="background:linear-gradient(135deg,#06BBCC,#059aaa);color:#fff;border:none;border-radius:12px;padding:12px 28px;font-family:'Nunito',sans-serif;font-weight:800;cursor:pointer;">
                        Voir toutes les formations
                    </button>
                </div>
            @else
                <div class="row g-4">
                    @foreach($formations as $formation)
                        <div class="col-lg-4 col-md-6">
                            <div class="fl-card">
                                <!-- Image -->
                                <div class="fl-card-img">
                                    @if($formation->photo && \Storage::exists('public/' . $formation->photo))
                                        <img src="{{ asset('storage/' . $formation->photo) }}" alt="{{ $formation->titre }}">
                                    @else
                                        <div class="fl-card-placeholder">
                                            <i class="fa fa-graduation-cap" style="font-size:3rem;color:rgba(6,187,204,.4);"></i>
                                        </div>
                                    @endif
                                    <!-- Badges over image -->
                                    @if($formation->categorie)
                                        <div style="position:absolute;top:12px;left:12px;" class="fl-badge fl-badge-cat">
                                            {{ $formation->categorie }}
                                        </div>
                                    @endif
                                    <div style="position:absolute;top:12px;right:12px;" class="fl-badge fl-badge-price">
                                        @if(!$formation->prix || $formation->prix == 0)
                                            Gratuit
                                        @else
                                            {{ number_format($formation->prix, 0, ',', ' ') }} FC
                                        @endif
                                    </div>
                                </div>
                                <!-- Body -->
                                <div class="fl-card-body">
                                    @if($formation->niveau)
                                        @php
                                            $lvlClass = match($formation->niveau) {
                                                'Débutant'      => 'fl-badge-level-deb',
                                                'Intermédiaire' => 'fl-badge-level-int',
                                                default         => 'fl-badge-level-adv',
                                            };
                                        @endphp
                                        <span class="fl-badge {{ $lvlClass }}" style="margin-bottom:10px;">
                                            {{ $formation->niveau }}
                                        </span>
                                    @endif
                                    <div class="fl-card-title">{{ $formation->titre }}</div>
                                    <div class="fl-card-desc">{{ $formation->description }}</div>
                                    <div class="fl-meta">
                                        @if($formation->formateur)
                                            <span><i class="fa fa-user-tie"></i>{{ $formation->formateur->nom ?? '' }}</span>
                                        @endif
                                        @if($formation->duree)
                                            <span><i class="fa fa-clock"></i>{{ $formation->duree }}</span>
                                        @endif
                                        @if($formation->lieu)
                                            <span><i class="fa fa-map-marker-alt"></i>{{ Str::limit($formation->lieu, 14) }}</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('formation.detail', $formation->id) }}" class="fl-cta">
                                        Voir les détails &nbsp;<i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Pagination -->
                @if($formations->hasPages())
                    <div class="d-flex justify-content-center mt-5">
                        {{ $formations->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
</div>
