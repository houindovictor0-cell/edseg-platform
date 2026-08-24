<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctorant extends Model
{
    protected $fillable = [
        'user_id', 'matricule', 'nom', 'prenom', 'telephone', 'email',
        'nationalite', 'photo', 'specialite', 'specialite_id', 'titre_these',
        'directeur_id', 'statut', 'annee_inscription', 'date_soutenance_prevue', 'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function directeur()
    {
        return $this->belongsTo(Enseignant::class, 'directeur_id');
    }

    public function specialiteRef()
    {
        return $this->belongsTo(Specialite::class, 'specialite_id');
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

    public function resultatsAnnuels()
    {
        return $this->hasMany(ResultatAnnuelDoctorant::class)->orderByDesc('annee_universitaire');
    }

    public function archives()
{
    return $this->morphMany(Archive::class, 'archivable')->orderByDesc('date_evenement');
}

    public function getPhotoUrlAttribute(): string
    {
        if (!$this->photo) return '/images/avatar.png';
        if (str_starts_with($this->photo, 'http')) return $this->photo;
        return asset('storage/' . $this->photo);
    }
}
