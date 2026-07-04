@component('layouts.defaultfrontend', ['title' => 'Faire un Don - CFP Mon Cœur'])
    <!-- Container pour l'application React -->
    <div class="container-xxl py-5">
        <div class="container">
            <div id="root" data-view="form"></div>
        </div>
    </div>

    @push('scripts')
        <!-- Chargement des assets compilés de l'application React -->
        <link rel="stylesheet" href="{{ asset('react-donation/assets/index.css') }}">
        <script src="{{ asset('react-donation/assets/index.js') }}" defer></script>
    @endpush
@endcomponent
