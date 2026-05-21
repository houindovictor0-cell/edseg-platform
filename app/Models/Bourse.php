<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bourse extends Model
{
    protected $fillable = [
        'titre', 'description', 'organisme', 'pays',
        'montant', 'date_limite', 'lien_candidature',
        'type', 'active'
    ];

    protected $casts = [
        'date_limite' => 'date',
        'active' => 'boolean',
        'montant' => 'decimal:2',
    ];
}
