<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bourse extends Model
{
    protected $fillable = [
        'titre', 'image', 'organisme', 'pays',
        'type', 'description', 'eligibilite',
        'montant', 'duree', 'date_limite',
        'lien_candidature', 'fichier', 'active',
    ];

    protected $casts = [
        'active'      => 'boolean',
        'date_limite' => 'date',
    ];

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return match($this->type) {
                'mobilite'  => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800&q=80',
                'recherche' => 'https://images.unsplash.com/photo-1532619675605-1ede6c2ed2b0?w=800&q=80',
                'formation' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=800&q=80',
                default     => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=800&q=80',
            };
        }
        if (str_starts_with($this->image, 'http')) return $this->image;
        return asset('storage/' . $this->image);
    }

    public function getFichierUrlAttribute(): ?string
    {
        if (!$this->fichier) return null;
        if (str_starts_with($this->fichier, 'http')) return $this->fichier;
        return asset('storage/' . $this->fichier);
    }

    public function getTypeLibelleAttribute(): string
    {
        return match($this->type) {
            'mobilite'  => 'Mobilité internationale',
            'recherche' => 'Bourse de recherche',
            'formation' => 'Formation',
            'autre'     => 'Autre opportunité',
            default     => ucfirst($this->type),
        };
    }

    public function isExpired(): bool
    {
        return $this->date_limite && $this->date_limite->isPast();
    }

    public function getDaysLeftAttribute(): int
    {
        if (!$this->date_limite) return 0;
        return max(0, now()->diffInDays($this->date_limite, false));
    }
}

