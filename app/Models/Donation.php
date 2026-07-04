<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'montant',
        'message',
        'date_don',
    ];

    protected $casts = [
        'montant' => 'decimal:2',
        'date_don' => 'datetime',
    ];
}
