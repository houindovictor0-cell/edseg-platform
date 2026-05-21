<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctorant;
use App\Models\User;
use App\Models\Enseignant;

class DoctorantSeeder extends Seeder
{
    public function run(): void
    {
        $user       = User::where('email', 'm.ahouandjinou@edseg-uac.bj')->first();
        $enseignant = Enseignant::first();

        Doctorant::create([
            'user_id'               => $user->id,
            'matricule'             => 'DOC-2026-001',
            'nom'                   => 'Ahouandjinou',
            'prenom'                => 'Marc',
            'telephone'             => '+229 96 00 00 01',
            'nationalite'           => 'Béninoise',
            'specialite'            => 'Gestion des Organisations',
            'titre_these'           => 'Impact de la gouvernance sur la performance des PME au Bénin',
            'directeur_id'          => $enseignant->id,
            'statut'                => 'inscrit',
            'annee_inscription'     => 2026,
            'date_soutenance_prevue'=> '2029-06-30',
        ]);
    }
} 
