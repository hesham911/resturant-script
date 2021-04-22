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
        Role::create(['name' => 'accountant']);
        Role::create(['name' => 'cashier']);
        Role::create(['name' => 'waiter']);
        Role::create(['name' => 'warehouse-manager']);
        Role::create(['name' => 'chef']);
        Role::create(['name' => 'client']);
        Role::create(['name' => 'owner']);
        Role::create(['name' => 'delivery']);
    }
}
