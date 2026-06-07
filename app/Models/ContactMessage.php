<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'sujet',
        'message',
        'lu',
    ];
}
