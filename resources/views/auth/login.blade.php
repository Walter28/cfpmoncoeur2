<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div style="display:inline-flex;align-items:center;gap:10px;">
                <div style="width:40px;height:40px;background:linear-gradient(135deg,#06BBCC,#059aaa);border-radius:10px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 14px rgba(6,187,204,.4);">
                    <i class="fa fa-graduation-cap" style="color:#fff;font-size:16px;"></i>
                </div>
                <span style="font-family:'Nunito',sans-serif;font-weight:800;font-size:1.1rem;color:#181d38;">CFP Mon Coeur</span>
            </div>
        </x-slot>

        <div style="margin-bottom:24px;">
            <h1 style="font-family:'Nunito',sans-serif;font-weight:800;font-size:1.5rem;color:#181d38;margin:0 0 6px;">Bon retour !</h1>
            <p style="color:#6b7280;font-size:.875rem;margin:0;">Connectez-vous pour accéder à votre espace formation.</p>
        </div>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div style="padding:10px 14px;background:#dcfce7;color:#16a34a;border-radius:8px;font-size:.875rem;margin-bottom:16px;">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="Adresse email" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="exemple@email.com" />
            </div>

            <div class="mt-4">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;">
                    <x-label for="password" value="Mot de passe" />
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" style="font-size:.8rem;color:#06BBCC;font-weight:600;text-decoration:none;">Mot de passe oublié ?</a>
                    @endif
                </div>
                <x-input id="password" class="block w-full" type="password" name="password" required autocomplete="current-password" placeholder="Votre mot de passe" />
            </div>

            <div style="margin-top:14px;display:flex;align-items:center;gap:8px;">
                <x-checkbox id="remember_me" name="remember" />
                <label for="remember_me" style="font-size:.85rem;color:#6b7280;cursor:pointer;">Se souvenir de moi</label>
            </div>

            <button type="submit" style="width:100%;margin-top:24px;padding:13px 24px;background:linear-gradient(135deg,#06BBCC,#059aaa);color:#fff;border:none;border-radius:10px;font-family:'Nunito',sans-serif;font-weight:700;font-size:.95rem;cursor:pointer;transition:all .3s;box-shadow:0 4px 16px rgba(6,187,204,.35);"
                onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 24px rgba(6,187,204,.5)'"
                onmouseout="this.style.transform='';this.style.boxShadow='0 4px 16px rgba(6,187,204,.35)'">
                Se connecter
            </button>
        </form>
    </x-authentication-card>
</x-guest-layout>
