<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            InfosEcoleSeeder::class,
            ChiffresClesSeeder::class,
            LaboratoireSeeder::class,
            EnseignantSeeder::class,
            TheseSeeder::class,
            TheseGestionSeeder::class,
            PartenaireSeeder::class,
            FilieresSeeder::class,
            AxesRechercheSeeder::class,
            SeminaireSeeder::class,
            ActualiteRicheSeeder::class,
        ]);
    }
}
