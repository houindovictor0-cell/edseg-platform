<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actualite extends Model
{
    protected $fillable = [
        'titre', 'contenu', 'image', 'categorie',
        'publiee', 'date_publication', 'user_id'
    ];

    protected $casts = [
        'publiee'          => 'boolean',
        'date_publication' => 'datetime',
    ];

    public function auteur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Accessor universel — gère URLs externes et fichiers locaux
    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=800&q=80';
        }
        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }
}
