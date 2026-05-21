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
            EnseignantSeeder::class,
            DoctorantSeeder::class,
            ActualiteRicheSeeder::class,
            ChiffresClesSeeder::class,
            FilieresSeeder::class,
            AxesRechercheSeeder::class,
            InfosEcoleSeeder::class,
        ]);
    }
}

