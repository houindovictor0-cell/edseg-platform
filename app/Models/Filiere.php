<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    protected $fillable = [
        'nom', 'code', 'description', 'accroche', 'debouches',
        'conditions_acces', 'programme', 'competences',
        'duree_annees', 'active', 'publiee',
        'places_disponibles', 'responsable',
        'email_responsable', 'image',
    ];

    protected $casts = [
        'active'  => 'boolean',
        'publiee' => 'boolean',
    ];

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=1200&q=80';
        }
        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }
}

