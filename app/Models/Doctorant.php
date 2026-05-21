<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctorant extends Model
{
    protected $fillable = [
        'user_id', 'matricule', 'nom', 'prenom', 'telephone',
        'nationalite', 'photo', 'specialite', 'titre_these',
        'directeur_id', 'statut', 'annee_inscription', 'date_soutenance_prevue'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function directeur()
    {
        return $this->belongsTo(Enseignant::class, 'directeur_id');
    }

    public function theses()
    {
        return $this->hasMany(These::class);
    }

    public function rapports()
    {
        return $this->hasMany(RapportAvancement::class);
    }

    public function soutenances()
    {
        return $this->hasMany(Soutenance::class);
    }
}
