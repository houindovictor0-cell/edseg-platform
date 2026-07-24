<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seminaire;

class SeminaireSeeder extends Seeder
{
    public function run(): void
    {
        $seminaires = [
            [
                'titre'                    => 'UAC-UNamur Vodoun Winter School of Economics — 2ème édition',
                'description'              => "Dans le cadre de la collaboration scientifique entre l'Université d'Abomey-Calavi (Bénin) et l'Université de Namur (Belgique), le deuxième workshop en science économique a réuni des chercheurs des deux universités à Ouidah du 11 au 12 janvier 2023.\n\nSix sessions de travaux ont été animées : Alimentation et sécurité alimentaire, Croissance économique, Environnement économique et institutions, Commerce international, Facteurs productivité et croissance, et Macro-Finance.\n\nSur dix-huit (18) communicateurs inscrits, seize (16) ont participé effectivement aux travaux, présentant des projets de doctorat et de post-doctorat. Des financements ERASMUS+ ont été attribués aux 4 meilleurs chercheurs à l'issue de la sélection.",
                'intervenant'              => 'Pr. Catherine GUIRKINGER, Pr. Christian KIEDAISCH, Pr. Marijke VERPOORTEN, Pr. Romain HOUSSA (UNamur)',
                'etablissement_intervenant'=> 'Université de Namur, Belgique',
                'date'                     => '2023-01-11',
                'heure_debut'              => '10:00',
                'heure_fin'               => '19:00',
                'lieu'                     => 'Ouidah, Bénin',
                'statut'                   => 'termine',
            ],
        ];

        foreach ($seminaires as $data) {
            Seminaire::create($data);
        }

        $this->command->info('Séminaires créés avec succès.');
    }
}

