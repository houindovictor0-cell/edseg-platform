<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiffreCle extends Model
{
    protected $table = 'chiffres_cles';

    protected $fillable = ['cle', 'valeur', 'label', 'description', 'ordre'];

    public static function avecComptagesLive()
    {
        $chiffres = self::orderBy('ordre')->get()->keyBy('cle');

        $comptages = [
            'doctorants_inscrits' => Doctorant::count().'+',
            'theses_soutenues' => These::where('statut', 'soutenue')->count().'+',
            'enseignants_chercheurs' => Enseignant::count().'+',
            'partenaires_internationaux' => Partenaire::where('portee', 'international')->count().'+',
        ];

        foreach ($comptages as $cle => $valeur) {
            if ($chiffres->has($cle)) {
                $chiffres[$cle]->valeur = $valeur;
            }
        }

        return $chiffres;
    }
}
