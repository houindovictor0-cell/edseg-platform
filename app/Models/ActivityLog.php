<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id', 'action', 'modele',
        'modele_id', 'details', 'ip_address', 'user_agent'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getIconAttribute(): string
    {
        return match(true) {
            str_contains($this->action, 'connexion')    => 'login',
            str_contains($this->action, 'candidature')  => 'file',
            str_contains($this->action, 'rapport')      => 'document',
            str_contains($this->action, 'message')      => 'mail',
            str_contains($this->action, 'publication')  => 'book',
            str_contains($this->action, 'thèse')        => 'academic',
            str_contains($this->action, 'utilisateur')  => 'user',
            str_contains($this->action, 'actualité')    => 'news',
            str_contains($this->action, 'filière')      => 'graduation',
            default                                      => 'activity',
        };
    }

    public function getColorAttribute(): string
    {
        return match(true) {
            str_contains($this->action, 'créé')      => 'green',
            str_contains($this->action, 'modifié')   => 'blue',
            str_contains($this->action, 'supprimé')  => 'red',
            str_contains($this->action, 'approuvé')  => 'green',
            str_contains($this->action, 'rejeté')    => 'red',
            str_contains($this->action, 'accepté')   => 'green',
            str_contains($this->action, 'connexion') => 'gold',
            default                                   => 'gray',
        };
    }
}

