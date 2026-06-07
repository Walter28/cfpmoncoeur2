<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    protected $fillable = ['etudiant_id', 
                        'formation_id',
                        'date_inscription'
                    ];

    public function formation()
    {
      return $this->belongsTo(Formation::class);
    }                

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

}
