<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $casts = [
        'date_debut' => 'date',
        'date_fin'   => 'date',
        'prix'       => 'decimal:2',
    ];

    protected $fillable = [
        'titre',
        'categorie',
        'niveau',
        'description',
        'objectif',
        'session',
        'prerequis',
        'duree',
        'date_debut',
        'date_fin',
        'lieu',
        'photo',
        'video',
        'formateur_id',
        'prix',
        'statut',
    ];

    const STATUTS = [
        'brouillon' => ['label' => 'Brouillon',  'color' => '#64748b', 'bg' => 'rgba(100,116,139,.12)', 'icon' => 'bi-pencil-fill'],
        'publiee'   => ['label' => 'Publiée',     'color' => '#10b981', 'bg' => 'rgba(16,185,129,.12)',  'icon' => 'bi-check-circle-fill'],
        'suspendue' => ['label' => 'Suspendue',   'color' => '#f59e0b', 'bg' => 'rgba(245,158,11,.12)',  'icon' => 'bi-pause-circle-fill'],
        'archivee'  => ['label' => 'Archivée',    'color' => '#ef4444', 'bg' => 'rgba(239,68,68,.12)',   'icon' => 'bi-archive-fill'],
    ];

    const CATEGORIES = [
        'Développement', 'Trading', 'Marketing', 'Design',
        'Business', 'Réparation', 'Langues', 'Informatique', 'Autre',
    ];

    const NIVEAUX = ['Débutant', 'Intermédiaire', 'Avancé'];

    public function formateur()
    {
        return $this->belongsTo(Formateur::class, 'formateur_id');
    }

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }

    public function getStatutInfoAttribute(): array
    {
        return self::STATUTS[$this->statut] ?? self::STATUTS['brouillon'];
    }
}
