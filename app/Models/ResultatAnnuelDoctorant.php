<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultatAnnuelDoctorant extends Model
{
    protected $table = 'resultats_annuels_doctorants';

    protected $fillable = [
        'doctorant_id', 'annee_universitaire', 'titre', 'fichier', 'commentaire',
    ];

    public function doctorant()
    {
        return $this->belongsTo(Doctorant::class);
    }

    public function getFichierUrlAttribute(): string
    {
        return asset('storage/' . $this->fichier);
    }
}
