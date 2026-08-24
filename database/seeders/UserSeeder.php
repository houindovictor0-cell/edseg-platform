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
            'password'          => Hash::make('Admin@ED-SEG2026'),
            'email_verified_at' => now(),
            'is_approved'       => true,
            'approved_at'       => now(),
        ]);
        $admin->assignRole('admin');
    }
}
