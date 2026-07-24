<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RapportAvancement extends Model
{
    protected $fillable = [
        'doctorant_id', 'these_id', 'titre', 'contenu',
        'fichier', 'statut', 'commentaire_directeur',
        'date_soumission', 'date_validation'
    ];

    protected $casts = [
        'date_soumission' => 'datetime',
        'date_validation' => 'datetime',
    ];

    

    protected $table = 'rapports_avancement';


    public function doctorant()
    {
        return $this->belongsTo(Doctorant::class);
    }

    public function these()
    {
        return $this->belongsTo(These::class);
    }
}

