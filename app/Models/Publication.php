<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $fillable = [
        'enseignant_id', 'titre', 'resume', 'auteurs',
        'revue', 'annee_publication', 'doi',
        'lien_externe', 'fichier', 'type'
    ];

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }
}
