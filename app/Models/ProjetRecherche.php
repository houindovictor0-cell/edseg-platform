<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjetRecherche extends Model
{
    protected $table = 'projets_recherche';

    protected $fillable = [
        'laboratoire_id', 'titre', 'description',
        'periode', 'bailleur', 'statut', 'publie', 'ordre',
    ];

    protected $casts = [
        'publie' => 'boolean',
    ];

    public function laboratoire()
    {
        return $this->belongsTo(Laboratoire::class);
    }

    public static function labelStatut(string $statut): string
    {
        return match ($statut) {
            'planifie' => 'Planifié',
            'en_cours' => 'En cours',
            'termine'  => 'Terminé',
            default    => $statut,
        };
    }
}

