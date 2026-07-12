<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Support\AdminPermissions;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::updateOrCreate(
            ['name' => 'Superadmin'],
            [
                'type' => 'superadmin',
                'permissions' => AdminPermissions::keys(),
                'is_active' => true,
            ],
        );
    }
}
