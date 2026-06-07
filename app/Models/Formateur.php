<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formateur extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'domaine',
        'contact',
        'email',
        'adresse',
        'date_naissance',
        'sexe',
        'user_id',
        'photo',
        'status',
        'password',
        'approuve',
    ];

    protected $casts = [
        'approuve' => 'boolean',
    ];

    public function formations()
    {
        return $this->hasMany(Formation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}

