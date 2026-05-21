<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    protected $fillable = [
        'user_id', 'matricule', 'nom', 'prenom', 'telephone',
        'photo', 'grade', 'specialite', 'est_directeur_these',
        'quota_theses', 'biographie'
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
}

