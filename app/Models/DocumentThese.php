<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentThese extends Model
{
    protected $table = 'documents_these';

    protected $fillable = [
        'these_id', 'titre', 'fichier', 'type', 'visible_public', 'ordre',
    ];

    protected $casts = [
        'visible_public' => 'boolean',
    ];

    public function these()
    {
        return $this->belongsTo(These::class);
    }

    public function getFichierUrlAttribute(): string
    {
        return asset('storage/' . $this->fichier);
    }

    public static function labelType(string $type): string
    {
        return match ($type) {
            'manuscrit'    => 'Manuscrit de thèse',
            'rapport_jury' => 'Rapport du jury',
            'autorisation' => 'Autorisation de soutenance',
            'annexe'       => 'Annexe',
            default        => 'Document',
        };
    }
}

