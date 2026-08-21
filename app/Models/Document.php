<?php
// app/Models/Document.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'titre', 'description', 'fichier',
        'categorie', 'type_resultat', 'annee',
        'acces', 'telechargements'
    ];

    public function getFichierUrlAttribute(): string
    {
        return asset('storage/' . $this->fichier);
    }

    public static function labelTypeResultat(string $type): string
    {
        return match ($type) {
            'preselection' => 'Résultats de présélection',
            'test_prepa'   => 'Résultats du test de cours préparatoire',
            'annuel'       => 'Résultats annuels des doctorants',
            default        => 'Résultat',
        };
    }
}

