<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Seminaire extends Model
{
    protected $fillable = [
        'titre', 'affiche', 'description', 'intervenant',
        'etablissement_intervenant', 'date', 'heure_debut',
        'heure_fin', 'lieu', 'fichier_support', 'compte_rendu', 'statut',
    ];

    protected $casts = ['date' => 'date'];

    public function getAfficheUrlAttribute(): string
    {
        if (! $this->affiche) {
            return '/images/seminaire.png';
        }
        if (str_starts_with($this->affiche, 'http')) {
            return $this->affiche;
        }
        if (str_starts_with($this->affiche, 'images/')) {
            return asset($this->affiche);
        }

        return asset('storage/'.$this->affiche);
    }

    public function images()
    {
        return $this->hasMany(SeminaireImage::class)->orderBy('ordre')->orderBy('id');
    }

    public function getHeureDebutLisibleAttribute(): string
    {
        return $this->formatHeure($this->heure_debut);
    }

    public function getHeureFinLisibleAttribute(): string
    {
        return $this->formatHeure($this->heure_fin);
    }

    private function formatHeure(?string $heure): string
    {
        if (! $heure) {
            return '';
        }

        return Carbon::parse($heure)->format('H\hi');
    }
}
