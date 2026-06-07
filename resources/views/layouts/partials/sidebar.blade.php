<div data-simplebar class="h-100">

    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
      <ul class="metismenu list-unstyled" id="side-menu">
    <li class="menu-title" key="t-menu">Menu</li>

        @if(Auth::user()->role=='super admin')
        {{-- SUPER ADMIN --}}
    <li>
        <a href="{{ route('dashboard') }}" class="waves-effect">
            <i class="bx bx-home-circle"></i>
            <span>Tableau de bord</span>
        </a>
    </li>

    <li>
        <a href="{{ route('formateur') }}" class="waves-effect">
            <i class="bx bx-user-voice"></i>
            <span>Formateurs</span>
        </a>
    </li>

    <li>
        <a href="{{ route('etudiant') }}" class="waves-effect">
            <i class="bx bx-user"></i>
            <span>Étudiants</span>
        </a>
    </li>

    <li>
        <a href="{{ route('formation') }}" class="waves-effect">
            <i class="bx bx-book-open"></i>
            <span>Formations</span>
        </a>
    </li>

    <li>
        <a href="{{ route('inscription') }}" class="waves-effect">
            <i class="bx bx-edit-alt"></i>
            <span>Inscriptions</span>
        </a>
    </li>

    <li>
        <a href="{{ route('dons') }}" class="waves-effect">
            <i class="bx bx-donate-heart"></i>
            <span>Dons</span>
        </a>
    </li>

    <li>
        <a href="{{ route('messages') }}" class="waves-effect">
            <i class="bx bx-envelope"></i>
            <span>Messages contact</span>
        </a>
    </li>

    @elseif(Auth::user()->role=='formateur')
    {{-- FORMATEUR --}}
    <li>
        <a href="{{ route('dashboard') }}" class="waves-effect">
            <i class="bx bx-home-circle"></i>
            <span>Tableau de bord</span>
        </a>
    </li>
    <li>
        <a href="{{ route('acceuil') }}" class="waves-effect" target="_blank">
            <i class="bx bx-globe"></i>
            <span>Voir le site</span>
        </a>
    </li>

    @elseif(Auth::user()->role=='etudiant')
    {{-- ETUDIANT --}}
    <li>
        <a href="{{ route('dashboard') }}" class="waves-effect">
            <i class="bx bx-home-circle"></i>
            <span>Tableau de bord</span>
        </a>
    </li>
    <li>
        <a href="{{ route('acceuil') }}#formations" class="waves-effect">
            <i class="bx bx-search"></i>
            <span>Explorer les formations</span>
        </a>
    </li>
    <li>
        <a href="{{ route('acceuil') }}" class="waves-effect" target="_blank">
            <i class="bx bx-globe"></i>
            <span>Voir le site</span>
        </a>
    </li>
    @endif

</ul>
    </div>
</div>
