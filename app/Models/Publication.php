<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $fillable = [
        'enseignant_id', 'titre', 'resume', 'auteurs',
        'revue', 'annee_publication', 'doi',
        'lien_externe', 'fichier', 'type', 'photo'
    ];

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }

    public function getPhotoUrlAttribute(): string
    {
        if (! $this->photo) {
            return $this->enseignant?->photo_url ?? '/images/avatar.png';
        }
        if (str_starts_with($this->photo, 'http')) {
            return $this->photo;
        }

        return asset('storage/'.$this->photo);
    }

    public function getFichierUrlAttribute(): ?string
    {
        return $this->fichier ? asset('storage/'.$this->fichier) : null;
    }
}
