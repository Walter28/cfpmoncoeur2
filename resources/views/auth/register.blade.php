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
            <h1 style="font-family:'Nunito',sans-serif;font-weight:800;font-size:1.5rem;color:#181d38;margin:0 0 6px;">Créer un compte</h1>
            <p style="color:#6b7280;font-size:.875rem;margin:0;">Rejoignez notre communauté de formation professionnelle.</p>
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="Nom complet" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Votre nom et prénom" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="Adresse email" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="exemple@email.com" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="Mot de passe" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="Minimum 8 caractères" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="Confirmer le mot de passe" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Répétez votre mot de passe" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />
                            <div class="ms-2" style="font-size:.8rem;color:#6b7280;">
                                {!! __("J'accepte les :terms_of_service et la :privacy_policy", [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" style="color:#06BBCC;font-weight:600;">Conditions d\'utilisation</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" style="color:#06BBCC;font-weight:600;">Politique de confidentialité</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <button type="submit" style="width:100%;margin-top:24px;padding:13px 24px;background:linear-gradient(135deg,#06BBCC,#059aaa);color:#fff;border:none;border-radius:10px;font-family:'Nunito',sans-serif;font-weight:700;font-size:.95rem;cursor:pointer;transition:all .3s;box-shadow:0 4px 16px rgba(6,187,204,.35);"
                onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 24px rgba(6,187,204,.5)'"
                onmouseout="this.style.transform='';this.style.boxShadow='0 4px 16px rgba(6,187,204,.35)'">
                Créer mon compte
            </button>
        </form>
    </x-authentication-card>
</x-guest-layout>
