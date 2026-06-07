<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Formateur;
use App\Models\Formation;
use App\Models\Etudiant;
use App\Models\Inscription;
use App\Models\Dons;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    // Super admin
    public $totalFormateurs;
    public $totalFormations;
    public $totalEtudiants;
    public $totalInscriptions;
    public $totalDons;
    public $totalMessages;
    public $pendingFormateurs;
    public $recentInscriptions;
    public $monthlyData;

    // Etudiant
    public $mesInscriptions;
    public $monProfil;

    // Formateur
    public $mesFormations;
    public $mesEtudiants;
    public $monProfilFormateur;

    public function render()
    {
        $user = Auth::user();
        $role = $user->role ?? 'etudiant';

        if ($role === 'super admin') {
            $this->loadAdminData();
        } elseif ($role === 'formateur') {
            $this->loadFormateurData($user);
        } else {
            $this->loadEtudiantData($user);
        }

        if ($role === 'super admin') {
            return view('livewire.dashboard')
                ->layout('layouts.defaultbackend', ['title' => 'Tableau de bord']);
        } elseif ($role === 'formateur') {
            return view('livewire.formateur.dashboard')
                ->layout('layouts.defaultformateur', ['title' => 'Mon Espace Formateur']);
        } else {
            return view('livewire.student.dashboard')
                ->layout('layouts.defaultstudent', ['title' => 'Mon Espace Étudiant']);
        }
    }

    private function loadAdminData(): void
    {
        $this->totalFormateurs   = Formateur::where('approuve', true)->count();
        $this->totalFormations   = Formation::count();
        $this->totalEtudiants    = Etudiant::count();
        $this->totalInscriptions = Inscription::count();
        $this->totalDons         = Dons::count();
        $this->totalMessages     = class_exists(ContactMessage::class)
            ? ContactMessage::where('lu', false)->count()
            : 0;
        $this->pendingFormateurs = Formateur::where('approuve', false)->count();

        $this->recentInscriptions = Inscription::with(['etudiant', 'formation'])
            ->latest()
            ->take(8)
            ->get();

        $this->monthlyData = collect(range(5, 0))->map(function ($i) {
            $month = now()->subMonths($i);
            return [
                'label' => $month->format('M'),
                'count' => Inscription::whereYear('created_at', $month->year)
                                      ->whereMonth('created_at', $month->month)
                                      ->count(),
            ];
        })->values()->toArray();
    }

    private function loadFormateurData($user): void
    {
        $this->monProfilFormateur = Formateur::where('user_id', $user->id)->first();

        if ($this->monProfilFormateur) {
            $this->mesFormations = Formation::where('formateur_id', $this->monProfilFormateur->id)
                ->latest()
                ->get();

            $formationIds = $this->mesFormations->pluck('id');
            $this->mesEtudiants = Inscription::with(['etudiant', 'formation'])
                ->whereIn('formation_id', $formationIds)
                ->latest()
                ->take(10)
                ->get();
        } else {
            $this->mesFormations = collect();
            $this->mesEtudiants  = collect();
        }

        $formationIds = $this->mesFormations ? $this->mesFormations->pluck('id') : collect();
        $this->monthlyData = collect(range(5, 0))->map(function ($i) use ($formationIds) {
            $month = now()->subMonths($i);
            return [
                'label' => $month->format('M'),
                'count' => $formationIds->count()
                    ? Inscription::whereIn('formation_id', $formationIds)
                                  ->whereYear('created_at', $month->year)
                                  ->whereMonth('created_at', $month->month)
                                  ->count()
                    : 0,
            ];
        })->values()->toArray();
    }

    private function loadEtudiantData($user): void
    {
        $this->monProfil = Etudiant::where('user_id', $user->id)->first();

        if ($this->monProfil) {
            $this->mesInscriptions = Inscription::with('formation.formateur')
                ->where('etudiant_id', $this->monProfil->id)
                ->latest()
                ->get();
        } else {
            $this->mesInscriptions = collect();
        }
    }
}
