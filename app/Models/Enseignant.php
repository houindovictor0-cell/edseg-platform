<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
protected $fillable = [
    'user_id',
    'matricule',
    'nom',
    'prenom',
    'telephone',
    'email',
    'photo',
    'grade',
    'specialite',
    'mention_id',
    'etablissement',
    'est_directeur_these',
    'quota_theses',
    'option',
    'provenance',
    'pays',
    'biographie',
    'notes',
];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function thesesEncadrees()
    {
        return $this->hasMany(These::class, 'directeur_id');
    }

    public function doctorants()
    {
        return $this->hasMany(Doctorant::class, 'directeur_id');
    }

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }

    public function specialites()
    {
        return $this->belongsToMany(Specialite::class, 'enseignant_specialite');
    }

    public function mention()
    {
        return $this->belongsTo(Mention::class);
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

