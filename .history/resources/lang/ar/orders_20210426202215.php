<?php

use function PHPSTORM_META\type;

return [
        'titles'        => [
            'index'     => 'الطلبات',
            'create'    => ' إضافة طلب  ',
            'edit'      => 'تعديل طلب',
            'show'      => ' عرض  طلب  ',
        ],
        'massages' => [
            'created_successfully' => 'تم إضافة الطلب  بنجاح',
            'updated_successfully' => 'تم تعديل الطلب  بنجاح',
            'cancel_successfully' => 'تم إلغاء الطلب  بنجاح',
            'change_status' => 'تم تغيير حالة الطلب  بنجاح',
            'deleted_successfully' => 'تم حذف  الطلب بنجاح',
            'error_occured' => 'حدث خطأ من فضلك راجع البيانات المطلوبة',
        ],
        'type'       =>[
            'floor'         => 'داخل الصالة',
            'delivery'         => 'ديليفري',
            'take_away'         => 'تيك اوي',
        ],
        'status'       =>[
            'orderd'         => 'تم الطلب',
            'prepared'         => 'تم التجهيز',
            'closed'         => 'تم إغلاق الطلب',
            'payment'         => 'تم الدفع',
            'canceled'         => 'تم الإلغاء',
            'mom'         => 'تم التجهيز',
        ],
        'actions'       =>[
            'close'         => 'إغلاق',
            'prepare'      => ' تجهيز',
            'payed'         => 'دفع',
            'cancel'        => 'إلغاء',
            'view'        => 'عرض',
        ],
        'view'       =>[
            'product'         => 'الصنف',
            'quantity'      => ' الكم',
            'payed'         => 'دفع',
            'cancel'        => 'إلغاء',
            'view'        => 'عرض',
        ],
        'client_id'                    => 'رقم العميل',
        'subcategory_id'               => 'القسم الفرعي',
        'order_type'                   => ' نوع الطلب',
        'total_price'                   => 'السعر الإجمالى',
        'order_status'                 => 'حالة الطلب',
        'table_id'                     => 'رقم الطاولة',
        'cancel_reason'                => 'سبب الإلغاء',
        'choose_table'                => '-- اختر الطاولة --',
        'no_thing'                => 'لا يوجد',
        'products'                => 'منتجات الطلب',
];
