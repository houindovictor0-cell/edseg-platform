<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChiffresClesSeeder extends Seeder
{
    public function run(): void
    {
        $chiffres = [
            ['cle' => 'doctorants_inscrits', 'valeur' => '120', 'label' => 'Doctorants inscrits', 'description' => 'Nombre total de doctorants actuellement inscrits', 'ordre' => 1],
            ['cle' => 'theses_soutenues', 'valeur' => '85', 'label' => 'Thèses soutenues', 'description' => 'Nombre total de thèses soutenues depuis la création', 'ordre' => 2],
            ['cle' => 'enseignants_chercheurs', 'valeur' => '30', 'label' => 'Enseignants-chercheurs', 'description' => 'Nombre d\'enseignants-chercheurs habilités', 'ordre' => 3],
            ['cle' => 'partenaires_internationaux', 'valeur' => '12', 'label' => 'Partenaires internationaux', 'description' => 'Nombre d\'universités et institutions partenaires', 'ordre' => 4],
            ['cle' => 'annee_creation', 'valeur' => '2002', 'label' => 'Année de création', 'description' => 'Année de création officielle de l\'EDSEG', 'ordre' => 5],
            ['cle' => 'laboratoires', 'valeur' => '6', 'label' => 'Laboratoires de recherche', 'description' => 'Nombre de laboratoires actifs', 'ordre' => 6],
        ];

        foreach ($chiffres as $c) {
            DB::table('chiffres_cles')->insert(array_merge($c, [
                'created_at' => now(), 'updated_at' => now()
            ]));
        }
    }
} 
