<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\FormateurCrud;
use App\Livewire\FormationCrud;
use App\Livewire\EtudiantCrud;
use App\Livewire\InscriptionCrud;
use App\Livewire\DonsCrud;
use App\Livewire\ContactMessagesCrud;
use App\Livewire\AdminUsersCrud;
use App\Livewire\Front\Index;
use App\Livewire\Front\About;
use App\Livewire\Front\Contact;
use App\Livewire\Front\FormationDetail;
use App\Livewire\Front\FormationsListe;
use App\Livewire\Profile\MonProfil;

// ── Redirect root ──
Route::get('/', fn() => redirect('acceuil'));

// ── Routes publiques ──
Route::get('/acceuil', Index::class)->name('acceuil');
Route::get('/about', About::class)->name('about');
Route::get('/contact', Contact::class)->name('contact');
Route::get('/formations/{id}', FormationDetail::class)->name('formation.detail');

// ── Catalogue public des formations ──
Route::get('/nos-formations', FormationsListe::class)
    ->name('nos-formations');

// ── Routes privées (authentifiées) ──
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::middleware('role:super admin')->group(function () {
        Route::get('/formateur', FormateurCrud::class)->name('formateur');
        Route::get('/formation', FormationCrud::class)->name('formation');
        Route::get('/etudiant', EtudiantCrud::class)->name('etudiant');
        Route::get('/inscription', InscriptionCrud::class)->name('inscription');
        Route::get('/dons', DonsCrud::class)->name('dons');
        Route::get('/messages', ContactMessagesCrud::class)->name('messages');
        Route::get('/admins', AdminUsersCrud::class)->name('admins');
    });

    Route::get('/mon-profil', MonProfil::class)->name('mon.profil');
});
