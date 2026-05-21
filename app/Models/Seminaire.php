<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Seminaire extends Model
{
    protected $fillable = [
        'titre','affiche','description','intervenant',
        'etablissement_intervenant','date','heure_debut',
        'heure_fin','lieu','fichier_support','compte_rendu','statut'
    ];
    protected $casts = ['date' => 'date'];

    public function getAfficheUrlAttribute(): string
    {
        if (!$this->affiche) return 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&q=80';
        if (str_starts_with($this->affiche, 'http')) return $this->affiche;
        return asset('storage/' . $this->affiche);
    }
}

