<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Création des rôles
        $admin      = Role::create(['name' => 'admin']);
        $enseignant = Role::create(['name' => 'enseignant']);
        $doctorant  = Role::create(['name' => 'doctorant']);

        // Permissions Admin
        $permissionsAdmin = [
            'gerer-utilisateurs',
            'gerer-candidatures',
            'gerer-actualites',
            'gerer-documents',
            'gerer-seminaires',
            'gerer-bourses',
            'voir-logs',
        ];

        // Permissions Enseignant
        $permissionsEnseignant = [
            'gerer-theses',
            'valider-rapports',
            'deposer-publications',
            'voir-doctorants',
        ];

        // Permissions Doctorant
        $permissionsDoctorant = [
            'deposer-rapports',
            'voir-these',
            'envoyer-messages',
            'voir-ressources',
        ];

        foreach ($permissionsAdmin as $perm) {
            Permission::create(['name' => $perm]);
        }
        foreach ($permissionsEnseignant as $perm) {
            Permission::create(['name' => $perm]);
        }
        foreach ($permissionsDoctorant as $perm) {
            Permission::create(['name' => $perm]);
        }

        // Attribution des permissions aux rôles
        $admin->givePermissionTo(Permission::all());
        $enseignant->givePermissionTo($permissionsEnseignant);
        $doctorant->givePermissionTo($permissionsDoctorant);
    }
}  
