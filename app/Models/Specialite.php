<?php
// app/Models/Specialite.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
    protected $table = 'specialites';

    protected $fillable = [
        'mention_id', 'nom', 'code', 'description', 'accroche', 'debouches',
        'conditions_acces', 'programme', 'competences',
        'duree_annees', 'active', 'publiee',
        'places_disponibles', 'responsable',
        'email_responsable', 'image',
    ];

    protected $casts = [
        'active'  => 'boolean',
        'publiee' => 'boolean',
    ];

    public function mention()
    {
        return $this->belongsTo(Mention::class);
    }

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return '/images/logo-2.png';
        }
        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }
}
