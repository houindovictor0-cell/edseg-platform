<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Vider le cache des permissions Spatie
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Compte Admin
        $admin = User::create([
            'name'              => 'Administrateur EDSEG',
            'email'             => 'admin@edseg-uac.bj',
            'password'          => Hash::make('Admin@edseg2026'),
            'email_verified_at' => now(),
             'is_approved'       => true,  // 👈 admin approuvé d'office
             'approved_at'       => now(),
        ]);
        $admin->assignRole('admin');

        // Compte Enseignant test
        $enseignant = User::create([
            'name'              => 'Prof. Kouassi Jean',
            'email'             => 'j.kouassi@edseg-uac.bj',
            'password'          => Hash::make('Enseignant@2026'),
            'email_verified_at' => now(),
             'is_approved'       => true,  // 👈 enseignant approuvé d'office
             'approved_at'       => now(),
        ]);
        $enseignant->assignRole('enseignant');

        // Compte Doctorant test
        $doctorant = User::create([
            'name'              => 'Ahouandjinou Marc',
            'email'             => 'm.ahouandjinou@edseg-uac.bj',
            'password'          => Hash::make('Doctorant@2026'),
            'email_verified_at' => now(),
             'is_approved'       => true,  // 👈 doctorant approuvé d'office
             'approved_at'       => now(),
        ]);
        $doctorant->assignRole('doctorant');
    }
} 


