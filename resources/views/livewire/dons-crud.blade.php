<div>
    <!-- Container pour la liste de dons en React -->
    <div id="root" data-view="list"></div>

    @push('scripts')
        <!-- Chargement des assets de l'application React pour l'administration -->
        <link rel="stylesheet" href="{{ asset('react-donation/assets/index.css') }}">
        <script src="{{ asset('react-donation/assets/index.js') }}" defer></script>
    @endpush
</div>
