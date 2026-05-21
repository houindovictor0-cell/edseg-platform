<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    protected $fillable = [
        'nom', 'prenom', 'email', 'telephone', 'nationalite',
        'diplome_obtenu', 'etablissement_origine', 'specialite_souhaitee',
        'projet_recherche', 'directeur_souhaite', 'dossier_fichier',
        'statut', 'commentaire_admin', 'annee_candidature'
    ];
}
