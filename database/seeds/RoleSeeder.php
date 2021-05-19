<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create roles and
        Role::create(['name' => 'محاسب']);
        Role::create(['name' => 'كاشير']);
        Role::create(['name' => 'صاله مان']);
        Role::create(['name' => 'مدير المخزن']);
        Role::create(['name' => 'الشيف']);
        Role::create(['name' => 'العميل']);
        Role::create(['name' => 'صاحب الموقع']);
        Role::create(['name' => 'ديليفري مان']);
    }
}
