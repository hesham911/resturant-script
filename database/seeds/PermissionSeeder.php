<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;


class PermissionSeeder extends Seeder
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

        //>>>>>>>Create system super operations
        Permission::create(['name' => 'add-user']);
        Permission::create(['name' => 'edit-user']);
        Permission::create(['name' => 'delete-user']);

        Permission::create(['name' => 'add-role']);
        Permission::create(['name' => 'edit-role']);
        Permission::create(['name' => 'delete-role']);

        Permission::create(['name' => 'add-category']);
        Permission::create(['name' => 'edit-category']);
        Permission::create(['name' => 'delete-category']);

        Permission::create(['name' => 'add-product']);
        Permission::create(['name' => 'edit-product']);
        Permission::create(['name' => 'delete-product']);

        Permission::create(['name' => 'add-zone']);
        Permission::create(['name' => 'edit-zone']);
        Permission::create(['name' => 'delete-zone']);

        Permission::create(['name' => 'add-area']);
        Permission::create(['name' => 'edit-area']);
        Permission::create(['name' => 'delete-area']);

        Permission::create(['name' => 'add-floor']);
        Permission::create(['name' => 'edit-floor']);
        Permission::create(['name' => 'delete-floor']);

        Permission::create(['name' => 'add-table']);
        Permission::create(['name' => 'edit-table']);
        Permission::create(['name' => 'delete-table']);

        Permission::create(['name' => 'add-setting']);
        Permission::create(['name' => 'edit-setting']);

        //>>>>>>>Create system Accounting operations
        Permission::create(['name' => 'view-report']);
        Permission::create(['name' => 'print-report']);

        Permission::create(['name' => 'add-indirect-cost']);
        Permission::create(['name' => 'edit-indirect-cost']);
        Permission::create(['name' => 'delete-indirect-cost']);

        Permission::create(['name' => 'add-indirect-expenses']);
        Permission::create(['name' => 'edit-indirect-expenses']);
       // Permission::create(['name' => 'delete-indirect-expenses']);


        //>>>>>>>Create system cashier operations
        Permission::create(['name' => 'add-order']);
        Permission::create(['name' => 'edit-order']);
        Permission::create(['name' => 'cancel-order']);

        Permission::create(['name' => 'approve-payment']);


        //>>>>>>>Create system kitchen operations
        Permission::create(['name' => 'add-product-manufacture']);
        Permission::create(['name' => 'edit-product-manufacture']);
        Permission::create(['name' => 'delete-product-manufacture']);

        Permission::create(['name' => 'add-request-kitchen']);
        Permission::create(['name' => 'edit-request-kitchen']);
        Permission::create(['name' => 'delete-request-kitchen']);

        //>>>>>>>Create system stock operations
        Permission::create(['name' => 'add-material']);
        Permission::create(['name' => 'edit-material']);
        Permission::create(['name' => 'delete-material']);

        Permission::create(['name' => 'add-supply']);
        Permission::create(['name' => 'edit-supply']);
        Permission::create(['name' => 'delete-supply']);

        Permission::create(['name' => 'add-material-measuring']);
        Permission::create(['name' => 'edit-material-measuring']);
        Permission::create(['name' => 'delete-material-measuring']);

    }
}
