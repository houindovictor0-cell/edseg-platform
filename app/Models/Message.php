<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'expediteur_id', 'destinataire_id',
        'sujet', 'contenu', 'lu', 'date_lecture'
    ];

    protected $casts = [
        'lu' => 'boolean',
        'date_lecture' => 'datetime',
    ];

    public function expediteur()
    {
        return $this->belongsTo(User::class, 'expediteur_id');
    }

    public function destinataire()
    {
        return $this->belongsTo(User::class, 'destinataire_id');
    }
}

