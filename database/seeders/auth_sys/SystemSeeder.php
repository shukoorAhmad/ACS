<?php

namespace Database\Seeders\auth_sys;

use App\Models\Auth\System;
use Illuminate\Database\Seeder;

class SystemSeeder extends Seeder
{
    public function run(): void
    {
        $systems = [
            [
                'name_da'    => 'مدیریت کاربران',
                'name_pa'    => 'د کاروونکی مدیریت',
                'name_en'    => 'User Management',
                'icon'    => 'icons/group.png',
                'route'    => 'user-management-sys',
            ],
            [
                'name_da'    => 'سیستم کنترل دسترسی',
                'name_pa'    => 'د لاسرسي کنټرول سیسټم',
                'name_en'    => 'Access Control System',
                'icon'    => 'icons/hiring.png',
                'route'    => 'acs-sys',
            ],

        ];

        foreach ($systems as $system)
            System::create($system);
    }
}
