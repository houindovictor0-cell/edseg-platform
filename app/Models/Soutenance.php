<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Soutenance extends Model
{
    protected $fillable = [
        'these_id', 'doctorant_id', 'date', 'heure',
        'lieu', 'jury', 'statut', 'mention', 'publique'
    ];

    protected $casts = [
        'date' => 'date',
        'publique' => 'boolean',
    ];

    public function these()
    {
        return $this->belongsTo(These::class);
    }

    public function doctorant()
    {
        return $this->belongsTo(Doctorant::class);
    }
}

