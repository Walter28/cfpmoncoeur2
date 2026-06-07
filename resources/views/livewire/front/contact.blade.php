<div>
<!-- ── Page Hero ── -->
<div style="background:linear-gradient(135deg,#181d38 0%,#0f1628 100%);padding:80px 0 60px;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><circle cx=%2220%22 cy=%2220%22 r=%2240%22 fill=%22rgba(6,187,204,0.04)%22/><circle cx=%2280%22 cy=%2280%22 r=%2260%22 fill=%22rgba(6,187,204,0.03)%22/></svg>') no-repeat center;background-size:cover;"></div>
    <div class="container" style="position:relative;z-index:1;">
        <div class="text-center">
            <span style="display:inline-block;background:rgba(6,187,204,.15);color:#06BBCC;border-radius:50px;padding:6px 18px;font-size:.75rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;margin-bottom:16px;">CONTACT</span>
            <h1 style="color:#fff;font-family:'Nunito',sans-serif;font-weight:800;font-size:clamp(2rem,4vw,3rem);margin-bottom:12px;">Contactez-nous</h1>
            <p style="color:rgba(255,255,255,.65);font-size:1rem;max-width:500px;margin:0 auto;">Une question, une demande d'information ? Notre équipe vous répond sous 24h.</p>
        </div>
    </div>
</div>

<!-- ── Main Content ── -->
<div class="py-5" style="background:#f8fafc;">
<div class="container">
<div class="row g-4 justify-content-center">

    <!-- ── Info Cards ── -->
    <div class="col-lg-4">
        <div class="d-flex flex-column gap-3 h-100">

            <div style="background:#fff;border-radius:16px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,.06);border:1px solid #f1f5f9;display:flex;align-items:flex-start;gap:16px;">
                <div style="width:48px;height:48px;background:linear-gradient(135deg,#06BBCC,#059aaa);border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fa fa-map-marker-alt" style="color:#fff;font-size:18px;"></i>
                </div>
                <div>
                    <h6 style="font-family:'Nunito',sans-serif;font-weight:800;color:#181d38;margin:0 0 4px;">Notre adresse</h6>
                    <p style="color:#6b7280;font-size:.875rem;margin:0;line-height:1.6;">Goma, Nord-Kivu<br>République Démocratique du Congo</p>
                </div>
            </div>

            <div style="background:#fff;border-radius:16px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,.06);border:1px solid #f1f5f9;display:flex;align-items:flex-start;gap:16px;">
                <div style="width:48px;height:48px;background:linear-gradient(135deg,#4f46e5,#3730a3);border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fa fa-phone" style="color:#fff;font-size:18px;"></i>
                </div>
                <div>
                    <h6 style="font-family:'Nunito',sans-serif;font-weight:800;color:#181d38;margin:0 0 4px;">Téléphone</h6>
                    <p style="color:#6b7280;font-size:.875rem;margin:0;line-height:1.6;">+243 xxx xxx xxx<br>Lun – Sam : 8h – 18h</p>
                </div>
            </div>

            <div style="background:#fff;border-radius:16px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,.06);border:1px solid #f1f5f9;display:flex;align-items:flex-start;gap:16px;">
                <div style="width:48px;height:48px;background:linear-gradient(135deg,#f59e0b,#d97706);border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fa fa-envelope" style="color:#fff;font-size:18px;"></i>
                </div>
                <div>
                    <h6 style="font-family:'Nunito',sans-serif;font-weight:800;color:#181d38;margin:0 0 4px;">Email</h6>
                    <p style="color:#6b7280;font-size:.875rem;margin:0;line-height:1.6;">contact@cfpmoncoeur.cd<br>Réponse sous 24h</p>
                </div>
            </div>

            <div style="background:#fff;border-radius:16px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,.06);border:1px solid #f1f5f9;display:flex;align-items:flex-start;gap:16px;">
                <div style="width:48px;height:48px;background:linear-gradient(135deg,#10b981,#059669);border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fa fa-clock" style="color:#fff;font-size:18px;"></i>
                </div>
                <div>
                    <h6 style="font-family:'Nunito',sans-serif;font-weight:800;color:#181d38;margin:0 0 4px;">Horaires d'ouverture</h6>
                    <p style="color:#6b7280;font-size:.875rem;margin:0;line-height:1.6;">Lundi – Vendredi : 8h – 17h<br>Samedi : 8h – 13h</p>
                </div>
            </div>

        </div>
    </div>

    <!-- ── Contact Form ── -->
    <div class="col-lg-7">
        <div style="background:#fff;border-radius:20px;padding:40px;box-shadow:0 4px 24px rgba(0,0,0,.08);border:1px solid #f1f5f9;">

            @if($sent)
            <!-- Success State -->
            <div class="text-center py-4">
                <div style="width:80px;height:80px;background:linear-gradient(135deg,#10b981,#059669);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
                    <i class="fa fa-check" style="color:#fff;font-size:32px;"></i>
                </div>
                <h4 style="font-family:'Nunito',sans-serif;font-weight:800;color:#181d38;margin-bottom:10px;">Message envoyé !</h4>
                <p style="color:#6b7280;margin-bottom:24px;">Merci de nous avoir contacté. Notre équipe vous répondra dans les 24 heures.</p>
                <button wire:click="resetForm" class="btn btn-primary px-5 py-3" style="border-radius:10px;font-weight:700;">
                    <i class="fa fa-paper-plane me-2"></i>Envoyer un autre message
                </button>
            </div>
            @else
            <!-- Form -->
            <div class="mb-4">
                <h4 style="font-family:'Nunito',sans-serif;font-weight:800;color:#181d38;margin-bottom:6px;">Envoyez-nous un message</h4>
                <p style="color:#9ca3af;font-size:.875rem;margin:0;">Tous les champs marqués * sont obligatoires.</p>
            </div>

            <form wire:submit.prevent="send">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label style="font-size:.82rem;font-weight:700;color:#374151;margin-bottom:6px;display:block;">Nom complet *</label>
                        <input wire:model.defer="nom" type="text" placeholder="Jean Dupont"
                               style="width:100%;border:1.5px solid {{ $errors->has('nom') ? '#f43f5e' : '#e5e7eb' }};border-radius:10px;padding:12px 16px;font-size:.9rem;outline:none;transition:border .2s;"
                               onfocus="this.style.borderColor='#06BBCC'" onblur="this.style.borderColor='{{ $errors->has('nom') ? '#f43f5e' : '#e5e7eb' }}'">
                        @error('nom') <span style="color:#f43f5e;font-size:.75rem;">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label style="font-size:.82rem;font-weight:700;color:#374151;margin-bottom:6px;display:block;">Adresse email *</label>
                        <input wire:model.defer="email" type="email" placeholder="jean@exemple.com"
                               style="width:100%;border:1.5px solid {{ $errors->has('email') ? '#f43f5e' : '#e5e7eb' }};border-radius:10px;padding:12px 16px;font-size:.9rem;outline:none;transition:border .2s;"
                               onfocus="this.style.borderColor='#06BBCC'" onblur="this.style.borderColor='{{ $errors->has('email') ? '#f43f5e' : '#e5e7eb' }}'">
                        @error('email') <span style="color:#f43f5e;font-size:.75rem;">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label style="font-size:.82rem;font-weight:700;color:#374151;margin-bottom:6px;display:block;">Téléphone</label>
                        <input wire:model.defer="telephone" type="text" placeholder="+243 xxx xxx xxx"
                               style="width:100%;border:1.5px solid #e5e7eb;border-radius:10px;padding:12px 16px;font-size:.9rem;outline:none;transition:border .2s;"
                               onfocus="this.style.borderColor='#06BBCC'" onblur="this.style.borderColor='#e5e7eb'">
                    </div>

                    <div class="col-md-6">
                        <label style="font-size:.82rem;font-weight:700;color:#374151;margin-bottom:6px;display:block;">Sujet *</label>
                        <select wire:model.defer="sujet"
                                style="width:100%;border:1.5px solid {{ $errors->has('sujet') ? '#f43f5e' : '#e5e7eb' }};border-radius:10px;padding:12px 16px;font-size:.9rem;outline:none;background:#fff;transition:border .2s;"
                                onfocus="this.style.borderColor='#06BBCC'" onblur="this.style.borderColor='{{ $errors->has('sujet') ? '#f43f5e' : '#e5e7eb' }}'">
                            <option value="">-- Sélectionnez un sujet --</option>
                            <option>Information sur une formation</option>
                            <option>Inscription</option>
                            <option>Partenariat</option>
                            <option>Problème technique</option>
                            <option>Autre</option>
                        </select>
                        @error('sujet') <span style="color:#f43f5e;font-size:.75rem;">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12">
                        <label style="font-size:.82rem;font-weight:700;color:#374151;margin-bottom:6px;display:block;">Message * <span style="color:#9ca3af;font-weight:400;">(min. 20 caractères)</span></label>
                        <textarea wire:model.defer="message" rows="6" placeholder="Décrivez votre demande en détail..."
                                  style="width:100%;border:1.5px solid {{ $errors->has('message') ? '#f43f5e' : '#e5e7eb' }};border-radius:10px;padding:12px 16px;font-size:.9rem;outline:none;resize:vertical;transition:border .2s;"
                                  onfocus="this.style.borderColor='#06BBCC'" onblur="this.style.borderColor='{{ $errors->has('message') ? '#f43f5e' : '#e5e7eb' }}'"></textarea>
                        @error('message') <span style="color:#f43f5e;font-size:.75rem;">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 mt-2">
                        <button type="submit"
                                style="background:linear-gradient(135deg,#06BBCC,#059aaa);color:#fff;border:none;border-radius:10px;padding:14px 36px;font-family:'Nunito',sans-serif;font-weight:700;font-size:1rem;cursor:pointer;display:inline-flex;align-items:center;gap:10px;transition:transform .15s,box-shadow .15s;"
                                onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 24px rgba(6,187,204,.35)'"
                                onmouseout="this.style.transform='';this.style.boxShadow=''">
                            <span wire:loading.remove wire:target="send"><i class="fa fa-paper-plane me-1"></i> Envoyer le message</span>
                            <span wire:loading wire:target="send"><i class="fa fa-spinner fa-spin me-1"></i> Envoi en cours...</span>
                        </button>
                    </div>

                </div>
            </form>
            @endif
        </div>
    </div>

</div>
</div>
</div>
</div>
