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
        Permission::create(['name' => 'عرض مستخدم']);
        Permission::create(['name' => 'إضافة مستخدم']);
        Permission::create(['name' => 'تعديل مستخدم']);
        Permission::create(['name' => 'حذف مستخدم']);

        Permission::create(['name' => 'عرض عميل']);
        Permission::create(['name' => 'إضافة عميل']);
        Permission::create(['name' => 'تعديل عميل']);
        Permission::create(['name' => 'حذف عميل']);

        Permission::create(['name' => 'عرض صلاحية']);
        Permission::create(['name' => 'إضافة صلاحية']);
        Permission::create(['name' => 'تعديل صلاحية']);
        Permission::create(['name' => 'حذف الصلاحية']);

        Permission::create(['name' => 'عرض قسم']);
        Permission::create(['name' => 'أضافة قسم']);
        Permission::create(['name' => 'تعديل قسم']);
        Permission::create(['name' => 'حذف القسم']);

        Permission::create(['name' => 'عرض منتج']);
        Permission::create(['name' => 'إضافة منتج']);
        Permission::create(['name' => 'تعديل منتج']);
        Permission::create(['name' => 'حذف المنتج']);

        Permission::create(['name' => 'عرض منطقة']);
        Permission::create(['name' => 'إضافة منطقة']);
        Permission::create(['name' => 'تعديل المنطقة']);
        Permission::create(['name' => 'حذف المنطقة']);

//        Permission::create(['name' => 'add-area']);
//        Permission::create(['name' => 'edit-area']);
//        Permission::create(['name' => 'delete-area']);

        Permission::create(['name' => 'عرض طابق']);
        Permission::create(['name' => 'إضافة طابق']);
        Permission::create(['name' => 'تعديل طابق']);
        Permission::create(['name' => 'حذف الطابق']);

        Permission::create(['name' => 'عرض طاولة']);
        Permission::create(['name' => 'إضافة طاولة']);
        Permission::create(['name' => 'تعديل طاولة']);
        Permission::create(['name' => 'حذف طاولة']);


        Permission::create(['name' => 'عرض إعدادات']);
        Permission::create(['name' => 'إضافة إعدادات']);
        Permission::create(['name' => 'تعديل إعدادات']);
        Permission::create(['name' => 'حذف إعدادات']);

        Permission::create(['name' => 'عرض رصيد المخزن']);


        //>>>>>>>Create system Accounting operations
        Permission::create(['name' => 'عرض التقارير']);
        Permission::create(['name' => 'طباعة التقرير']);

        Permission::create(['name' => 'عرض تكاليف غير مباشرة']);
        Permission::create(['name' => 'إضافة تكاليف غير مباشرة']);
        Permission::create(['name' => 'تعديل تكاليف غير مباشرة']);
        Permission::create(['name' => 'حذف تكاليف غير مباشرة']);

        Permission::create(['name' => 'عرض مصروفات غير مباشرة']);
        Permission::create(['name' => 'إضافة مصروفات غير مباشرة']);
        Permission::create(['name' => 'تعديل مصروفات غير مباشرة']);
       // Permission::create(['name' => 'delete-indirect-expenses']);


        //>>>>>>>Create system cashier operations
        Permission::create(['name' => 'عرض طلب']);
        Permission::create(['name' => 'إضافة طلب']);
        Permission::create(['name' => 'تعديل طلب']);
        Permission::create(['name' => 'إلغاء طلب']);

        Permission::create(['name' => 'تأكيد الدفع']);
        Permission::create(['name' => 'البحث عن عملاء']);


        //>>>>>>>Create system kitchen operations
        Permission::create(['name' => 'عرض تصنيع منتج']);
        Permission::create(['name' => 'إضافة تصنيع منتج']);
        Permission::create(['name' => 'تعديل تصنيع منتج']);
        Permission::create(['name' => 'حذف تصنيع المنتج']);

        Permission::create(['name' => 'عرض طلبية من المطبخ']);
        Permission::create(['name' => 'إضافة طلبية من المطبخ']);
        Permission::create(['name' => 'تعديل طلبية من المطبخ']);
        Permission::create(['name' => 'حذف طلبية من المطبخ']);

        //>>>>>>>Create system stock operations
        Permission::create(['name' => 'عرض مواد خام']);
        Permission::create(['name' => 'إضافة مواد خام']);
        Permission::create(['name' => 'تعديل مواد خام']);
        Permission::create(['name' => 'حذف مواد خام']);

        Permission::create(['name' => 'عرض توريد للمخزن']);
        Permission::create(['name' => 'إضافة توريد للمخزن']);
        Permission::create(['name' => 'تعديل توريد للمخزن']);
        Permission::create(['name' => 'حذف توريد للمخزن']);

        Permission::create(['name' => 'عرض قياس المواد الخام']);
        Permission::create(['name' => 'إضافة قياس المواد الخام']);
        Permission::create(['name' => 'تعديل قياس المواد الخام']);
        Permission::create(['name' => 'حذف قياس المواد الخام']);

    }
}
