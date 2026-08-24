<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);

        $permissionsAdmin = [
            'gerer-utilisateurs',
            'gerer-candidatures',
            'gerer-actualites',
            'gerer-documents',
            'gerer-seminaires',
            'gerer-bourses',
            'voir-logs',
        ];

        foreach ($permissionsAdmin as $perm) {
            Permission::create(['name' => $perm]);
        }

        $admin->givePermissionTo(Permission::all());
    }
}
