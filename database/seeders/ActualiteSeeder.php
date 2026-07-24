<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Actualite;
use App\Models\User;

class ActualiteSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::whereHas('roles', function ($query) {
    $query->where('name', 'admin');
})->first();

if (!$admin) {
    $admin = User::first();
}

        $actualites = [
            [
                'titre'            => 'Ouverture des inscriptions en doctorat 2026-2027',
                'contenu'          => 'L\'École Doctorale des Sciences Économiques et de Gestion de l\'UAC ouvre ses inscriptions pour l\'année académique 2026-2027. Les candidats sont invités à soumettre leur dossier avant le 30 juin 2026.',
                'categorie'        => 'communique',
                'publiee'          => true,
                'date_publication' => now(),
                'user_id'          => $admin->id,
            ],
            [
                'titre'            => 'Séminaire doctoral — Méthodologie de recherche en gestion',
                'contenu'          => 'Un séminaire doctoral sur la méthodologie de recherche en sciences de gestion se tiendra le 20 mai 2026 à l\'amphi A de la FASEG. Tous les doctorants sont invités à participer.',
                'categorie'        => 'actualite',
                'publiee'          => true,
                'date_publication' => now(),
                'user_id'          => $admin->id,
            ],
            [
                'titre'            => 'Bourse de mobilité — Université de Bordeaux 2026',
                'contenu'          => 'L\'Université de Bordeaux offre des bourses de mobilité aux doctorants des universités partenaires africaines. Dossiers à soumettre avant le 15 mai 2026.',
                'categorie'        => 'offre',
                'publiee'          => true,
                'date_publication' => now(),
                'user_id'          => $admin->id,
            ],
        ];

        foreach ($actualites as $actualite) {
            Actualite::create($actualite);
        }
    }
} 

