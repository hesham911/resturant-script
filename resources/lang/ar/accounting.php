<?php

return [

    'indirect-cost' =>[
        'titles'            => [
            'index'                 => ' التكاليف الغير مباشرة ',
            'create'                => ' إضافة تكاليف ',
            'subcreate'             => 'إضافة تكاليف جديدة',
            'edit'                  => 'تعديل  التكاليف  ',
            'show'                  => ' عرض  التكاليف  ',
        ],
        'placeholder'       => [
            'name'                       => ' الاسم التكاليف ',
        ],
        'massages'          => [
            'created_successfully'   => 'تم  تسجيل  التكاليف   بنجاح',
            'updated_successfully'   => 'تم تعديل  التكاليف بنجاح',
            'deleted_check'          => 'هل تريد حقا حذف هذة التكاليف',
            'deleted_successfully'   => 'تم حذف  التكاليف بنجاح',
            'error_successfully'     => 'حدث خطأ من فضلك راجع البيانات المطلوبة',
        ],
        'name'                       => ' الاسم ',
    ],

    'banks' =>[
        'titles'            => [
            'index'                 => ' الخزينة ',
            'create'                => ' إضافة خزينة ',
            'subcreate'             => 'إضافة خزينة جديدة',
            'edit'                  => 'تعديل  الخزينة  ',
            'show'                  => ' عرض  الخزينة  ',
        ],
        'placeholder'       => [
            'name'                       => ' الاسم الخزينة ',
            'notes'                      => ' ملحوظات ',
            'balance'                    => ' الرصيد الإفتتاحي ',
        ],
        'massages'          => [
            'created_successfully'   => 'تم  تسجيل  الخزينة   بنجاح',
            'updated_successfully'   => 'تم تعديل  الخزينة بنجاح',
            'deleted_check'          => 'هل تريد حقا حذف هذة الخزينة',
            'deleted_successfully'   => 'تم حذف  الخزينة بنجاح',
            'error_successfully'     => 'حدث خطأ من فضلك راجع البيانات المطلوبة',
            'create_bank'            => 'إنشاء خزينة جديدة',
            'cant_edit_balance'      => 'تلك الخزينة تم عليها معاملات  لا يمكن تغير الرصيد الإفتتاحي',
            'cant_delete_bank'       => 'لا يمكن الحذف',
        ],
        'name'                       => ' الاسم ',
        'notes'                      => ' ملحوظات ',
        'balance'                    => ' الرصيد الإفتتاحي ',
    ],

    'transactions' =>[
        'titles'            => [
            'index'                 => ' التحويل الأموال ',
            'create'                => ' إضافة تحويل  ',
            'subcreate'             => 'إضافة تحويل جديدة',
            'edit'                  => 'تعديل  تحويل  ',
            'show'                  => ' عرض  تحويل  ',
        ],
        'placeholder'       => [
            'fromBank'                   => ' اختر الخزينة المحول منها ',
            'toBank'                     => ' اختر الخزينة المحول إليها ',
            'notes'                      => ' ملحوظات ',
            'amount'                     => ' مبلغ الحركة المالية ',
        ],
        'massages'          => [
            'created_successfully'   => 'تم  تسجيل  التحويل   بنجاح',
            'updated_successfully'   => 'تم تعديل  التحويل بنجاح',
            'deleted_check'          => 'هل تريد حقا حذف هذة التحويل',
            'deleted_successfully'   => 'تم حذف  التحويل بنجاح',
            'error_successfully'     => 'حدث خطأ من فضلك راجع البيانات المطلوبة',
            'create_bank'            => 'إنشاء تحويل جديدة',
            'less_banks'             => 'يجب أن يكون مضافة خزنتين علي الأقل لإتمام العملية',
            'cant_edit_balance'      => 'تلك الخزينة تم عليها معاملات  لا يمكن تغير الرصيد الإفتتاحي',
            'cant_delete_bank'       => 'لا يمكن الحذف',
        ],
        'fromBank'                   => ' من الخزينة ',
        'toBank'                     => ' إلي الخزينة ',
        'notes'                      => ' ملحوظات ',
        'amount'                     => 'المبلغ ',
        'date'                       => 'تاريخ ',
    ],

    'indirect-expenses' =>[
        'titles'            => [
            'index'                 => ' المصاريف ',
            'create'                => ' إضافة الصرف ',
            'subcreate'             => 'إضافة صرف جديد',
            'edit'                  => 'تعديل  الصرف  ',
            'show'                  => ' عرض  الصرف  ',
            'search'                => ' البحث في المصاريف  ',
        ],
        'placeholder'       => [
            'cost'                       => ' اسم التكليف الخاص بالمصروف ',
            'daterangepicker'            => ' التاريخ من - إلي ',
            'amount'                     => ' المبلغ المصروف ',
        ],
        'massages'          => [
            'created_successfully'   => 'تم  تسجيل  المصرف   بنجاح',
            'updated_successfully'   => 'تم تعديل  المصرف بنجاح',
            'deleted_check'          => 'هل تريد حقا حذف هذة المصرف',
            'deleted_successfully'   => 'تم حذف  المصرف بنجاح',
            'error_successfully'     => 'حدث خطأ من فضلك راجع البيانات المطلوبة',
        ],
        'cost'                       => ' التكليف ',
        'daterangepicker'            => ' التاريخ من - إلي ',
        'amount'                     => ' المبلغ ',
        'date_from'                  => ' من تاريخ ',
        'date_to'                    => ' إلي تاريخ ',
    ],
];