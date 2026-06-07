<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dons extends Model
{
    protected $fillable = [
        'nom_donateur',
        'prenom_donateur',
        'contact_donateur',
        'email_donateur',
        'adresse_donateur',
        'date_don',
        'montant_don',
    ];
}
