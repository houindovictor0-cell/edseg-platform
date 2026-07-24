<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Admin principal = Directeur ED-SEG
        $admin = User::create([
            'name'              => 'Pr. Cossi Emmanuel HOUNKOU',
            'email'             => 'ecoledoctoraleseguac@gmail.com',
            'password'          => Hash::make('Admin@EDSEG2026'),
            'email_verified_at' => now(),
            'is_approved'       => true,
            'approved_at'       => now(),
        ]);
        $admin->assignRole('admin');

        // Compte test enseignant
        $enseignant = User::create([
            'name'              => 'Pr. Augustin Foster CHABOSSOU',
            'email'             => 'a.chabossou@edseg-uac.bj',
            'password'          => Hash::make('Enseignant@2026'),
            'email_verified_at' => now(),
            'is_approved'       => true,
            'approved_at'       => now(),
        ]);
        $enseignant->assignRole('enseignant');

        // Compte test doctorant
        $doctorant = User::create([
            'name'              => 'Doctorant Test',
            'email'             => 'doctorant@edseg-uac.bj',
            'password'          => Hash::make('Doctorant@2026'),
            'email_verified_at' => now(),
            'is_approved'       => true,
            'approved_at'       => now(),
        ]);
        $doctorant->assignRole('doctorant');
    }
}

