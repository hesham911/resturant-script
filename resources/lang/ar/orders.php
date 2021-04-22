<?php

use function PHPSTORM_META\type;

return [
        'titles'        => [
            'index'     => 'الطلبات',
            'create'    => ' إضافة طلب  ',
            'edit'      => 'تعديل طلب',
            'show'      => ' عرض  طلب  ',
        ],
        'notifications' => [
            'created_succesfully' => 'تم إضافة طلب  بنجاح',
            'updated_succesfully' => 'تم تعديل الطلب  بنجاح',
            'cancel_succesfully' => 'تم إلغاء الطلب  بنجاح',
            'change_status' => 'تم تغيير حالة الطلب  بنجاح',
            'deleted_succesfully' => 'تم حذف  الطلب بنجاح',
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
        ],
        'actions'       =>[
            'close'         => 'إغلاق',
            'prepared'         => 'تم التجهيز',
            'payed'         => 'تم الدفع',
            'cancel'         => 'إلغاء',
        ],
        'client_id'                    => 'رقم العميل',
        'subcategory_id'               => 'القسم الفرعي',
        'type'                         => ' نوع الطلب',
        'status'                       => 'حالة الطلب',
        'table_id'                     => 'رقم الترابيزة',
        'cancel_reason'                => 'سبب الإلغاء',
];
