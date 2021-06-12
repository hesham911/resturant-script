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
        Role::create(['name' => 'التحكم-في-المستخدمين']);
        Role::create(['name' => 'التحكم-في-العملاء']);
        Role::create(['name' => 'التحكم-في-الصلاحيات']);
        Role::create(['name' => 'التحكم-في-الأقسام']);
        Role::create(['name' => 'التحكم-في-المنتجات']);
        Role::create(['name' => 'التحكم-في-المنطقة']);
        Role::create(['name' => 'التحكم-في-الطاولة']);
        Role::create(['name' => 'التحكم-في-الطابق']);
        Role::create(['name' => 'التحكم-في-الإعدادات']);
        Role::create(['name' => 'التحكم-في-التقارير']);
        Role::create(['name' => 'التحكم-في-التكاليف']);
        Role::create(['name' => 'التحكم-في-الطلبات']);
        Role::create(['name' => 'التحكم-في-تصنيع-المنتج']);
        Role::create(['name' => 'التحكم-في-المواد-الخام']);
        Role::create(['name' => 'التحكم-في-المخزن']);
        Role::create(['name' => 'التحكم-في-التلفيات']);
        Role::create(['name' => 'التحكم-في-الشيفت']);
        Role::create(['name' => 'التحكم-في-تحويلات-المالية']);
        Role::create(['name' => 'التحكم-في-الخزينة']);
    }
}
