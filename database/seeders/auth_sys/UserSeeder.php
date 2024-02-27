<?php

namespace Database\Seeders\auth_sys;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // to create super admin
        $permissions = Permission::get();
        $role = Role::create([
            'name' => 'Super Admin',
            'guard_name' => 'web',
            'system_id' => 1,
        ]);

        $role->syncPermissions($permissions);

        $user = User::create([
            'username'    => 'Administrator',
            'name'    => 'Administrator',
            'email'         => 'admin@gmail.com',
            'password'      =>  Hash::make('Password!@#123'),
            'created_by' => 1,
            'image' => null,
        ]);
        $user->assignRole($role);

        // to create register employee role and user
        $role = Role::create([
            'name' => 'Register Employee',
            'guard_name' => 'web',
            'system_id' => 1,
        ]);

        $role->syncPermissions([10,11,12,13]);

        $user = User::create([
            'username'    => 'reg-emp',
            'name'    => 'reg-emp',
            'email'         => 'reg.emp@gmail.com',
            'password'      =>  Hash::make('Password!@#123'),
            'created_by' => 1,
            'image' => null,
        ]);
        $user->assignRole($role);
        
        // to create super admin
        $role = Role::create([
            'name' => 'check-emp',
            'guard_name' => 'web',
            'system_id' => 2,
        ]);

        $role->syncPermissions(14);

        $user = User::create([
            'username'    => 'check-emp',
            'name'    => 'check-emp',
            'email'         => 'check-emp@gmail.com',
            'password'      =>  Hash::make('Password!@#123'),
            'created_by' => 1,
            'image' => null,
        ]);
        $user->assignRole($role);
        
    }
}
