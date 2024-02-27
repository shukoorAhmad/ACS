<?php

namespace Database\Seeders\auth_sys;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{

    public function run(): void
    {
        $permissions = [
            [
                'name'    => 'users-menu',
                'guard_name'    => 'web',
                'system_id'    => 1,
            ],
            [
                'name'    => 'user-create',
                'guard_name'    => 'web',
                'system_id'    => 1,
            ],
            [
                'name'    => 'user-list',
                'guard_name'    => 'web',
                'system_id'    => 1,
            ],
            [
                'name'    => 'user-edit',
                'guard_name'    => 'web',
                'system_id'    => 1,
            ],
            [
                'name'    => 'user-destroy',
                'guard_name'    => 'web',
                'system_id'    => 1,
            ],
            [
                'name'    => 'roles-menu',
                'guard_name'    => 'web',
                'system_id'    => 1,
            ],
            [
                'name'    => 'role-create',
                'guard_name'    => 'web',
                'system_id'    => 1,
            ],
            [
                'name'    => 'role-list',
                'guard_name'    => 'web',
                'system_id'    => 1,
            ],
            [
                'name'    => 'role-edit',
                'guard_name'    => 'web',
                'system_id'    => 1,
            ],
            // ACS
            [
                'name'    => 'employee-list',
                'guard_name'    => 'web',
                'system_id'    => 2,
            ],
            [
                'name'    => 'employee-create',
                'guard_name'    => 'web',
                'system_id'    => 2,
            ],
            [
                'name'    => 'employee-edit',
                'guard_name'    => 'web',
                'system_id'    => 2,
            ],
            [
                'name'    => 'employee-delete',
                'guard_name'    => 'web',
                'system_id'    => 2,
            ],
            [
                'name'    => 'employee-check',
                'guard_name'    => 'web',
                'system_id'    => 2,
            ],
        ];

        foreach ($permissions as $permission)
            Permission::create($permission);
    }
}
