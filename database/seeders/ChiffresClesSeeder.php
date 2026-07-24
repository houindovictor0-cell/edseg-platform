<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChiffresClesSeeder extends Seeder
{
    public function run(): void
    {
        $chiffres = [
    ['cle' => 'doctorants_inscrits',       'valeur' => '200+', 'label' => 'Doctorants inscrits',        'description' => 'Doctorants actuellement inscrits à l\'ED-SEG',             'ordre' => 1],
    ['cle' => 'theses_soutenues',          'valeur' => '250+', 'label' => 'Thèses soutenues',           'description' => 'Thèses soutenues depuis 2009 en Économie et Gestion',       'ordre' => 2],
    ['cle' => 'enseignants_chercheurs',    'valeur' => '58',   'label' => 'Encadreurs-chercheurs',      'description' => 'Enseignants-chercheurs habilités à diriger des thèses',      'ordre' => 3],
    ['cle' => 'partenaires_internationaux','valeur' => '20+',  'label' => 'Professeurs étrangers',      'description' => 'Professeurs étrangers appuyant l\'ED-SEG',                   'ordre' => 4],
    ['cle' => 'laboratoires',              'valeur' => '9',    'label' => 'Laboratoires affiliés',      'description' => '9 laboratoires de recherche affiliés',                       'ordre' => 5],
    ['cle' => 'alumni',                    'valeur' => '90+',  'label' => 'Docteurs diplômés',          'description' => 'Alumni de l\'ED-SEG en poste au Bénin et à l\'international', 'ordre' => 6],
];

        foreach ($chiffres as $c) {
            DB::table('chiffres_cles')->insert(array_merge($c, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('Chiffres clés réels de l\'ED-SEG insérés.');
    }
}

