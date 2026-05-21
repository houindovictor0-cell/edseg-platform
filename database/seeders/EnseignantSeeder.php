<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Enseignant;
use App\Models\User;

class EnseignantSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'j.kouassi@edseg-uac.bj')->first();

        Enseignant::create([
            'user_id'             => $user->id,
            'matricule'           => 'ENS-2026-001',
            'nom'                 => 'Kouassi',
            'prenom'              => 'Jean',
            'telephone'           => '+229 97 00 00 01',
            'grade'               => 'Professeur Titulaire',
            'specialite'          => 'Économie du Développement',
            'est_directeur_these' => true,
            'quota_theses'        => 5,
            'biographie'          => 'Professeur titulaire en économie du développement avec plus de 20 ans d\'expérience.',
        ]);
    }
} 

