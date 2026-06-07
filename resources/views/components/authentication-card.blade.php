<div>
    <div class="auth-form-header">
        <div style="display:flex;justify-content:center;margin-bottom:16px;">
            {{ $logo }}
        </div>
    </div>

    <div class="auth-card">
        {{ $slot }}
    </div>

    <div class="auth-switch">
        @if(request()->routeIs('login'))
            Pas encore de compte ?
            <a href="{{ route('register') }}">S'inscrire gratuitement</a>
        @else
            Déjà un compte ?
            <a href="{{ route('login') }}">Se connecter</a>
        @endif
    </div>
</div>
