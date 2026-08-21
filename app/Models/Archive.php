<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    protected $fillable = [
        'archivable_id', 'archivable_type', 'titre', 'type',
        'description', 'date_evenement', 'fichier', 'cree_par',
    ];

    protected $casts = [
        'date_evenement' => 'date',
    ];

    public function archivable()
    {
        return $this->morphTo();
    }

    public function auteur()
    {
        return $this->belongsTo(User::class, 'cree_par');
    }

    public function getFichierUrlAttribute(): ?string
    {
        return $this->fichier ? asset('storage/' . $this->fichier) : null;
    }

    public static function labelType(string $type): string
    {
        return match ($type) {
            'these'       => 'Thèse',
            'publication' => 'Publication',
            'distinction' => 'Distinction / Prix',
            'rapport'     => 'Rapport',
            'note'        => 'Note',
            default       => 'Autre',
        };
    }
}

