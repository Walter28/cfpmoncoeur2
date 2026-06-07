<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'contact',
        'email',
        'adresse',
        'date_naissance',
        'sexe',
        'photo',
        'user_id',
    ];

    protected $casts = [
        'date_naissance' => 'date',
    ];

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
