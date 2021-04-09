<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'date_equals' => 'The :attribute must be a date equal to :date.',
    'ends_with' => 'The :attribute must end with one of the following: :values',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'not_regex' => 'The :attribute format is invalid.',
    'starts_with' => 'The :attribute must start with one of the following: :values',
    'uuid' => 'The :attribute must be a valid UUID.',


    'accepted'             => 'يجب قبول الحقل :attribute',
    'active_url'           => 'الحقل :attribute لا يُمثّل رابطًا صحيحًا',
    'after'                => 'يجب على الحقل :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'يجب أن لا يحتوي الحقل :attribute سوى على حروف',
    'alpha_dash'           => 'يجب أن لا يحتوي الحقل :attribute على حروف، أرقام ومطّات.',
    'alpha_num'            => 'يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط',
    'array'                => 'يجب أن يكون الحقل :attribute ًمصفوفة',
    'before'               => 'يجب على الحقل :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
        'file'    => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.',
        'string'  => 'يجب أن يكون عدد حروف النّص :attribute بين :min و :max',
        'array'   => 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max',
    ],
    'boolean'              => 'يجب أن تكون قيمة الحقل :attribute إما true أو false ',
    'confirmed'            => 'حقل التأكيد غير مُطابق للحقل :attribute',
    'date'                 => 'الحقل :attribute ليس تاريخًا صحيحًا',
    'date_format'          => 'لا يتوافق الحقل :attribute مع الشكل :format.',
    'different'            => 'يجب أن يكون الحقلان :attribute و :other مُختلفان',
    'digits'               => 'يجب أن يحتوي الحقل :attribute على :digits رقمًا/أرقام',
    'digits_between'       => 'يجب أن يحتوي الحقل :attribute بين :min و :max رقمًا/أرقام ',
    'dimensions'           => 'الـ :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct'             => 'للحقل :attribute قيمة مُكرّرة.',
    'email'                => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح البُنية',
    'exists'               => 'الحقل :attribute لاغٍ',
    'file'                 => 'الـ :attribute يجب أن يكون من ملفا.',
    'filled'               => 'الحقل :attribute إجباري',
    'image'                => 'يجب أن يكون الحقل :attribute صورةً',
    'in'                   => 'الحقل :attribute لاغٍ',
    'in_array'             => 'الحقل :attribute غير موجود في :other.',
    'integer'              => 'يجب أن يكون الحقل :attribute عددًا صحيحًا',
    'ip'                   => 'يجب أن يكون الحقل :attribute عنوان IP ذا بُنية صحيحة',
    'json'                 => 'يجب أن يكون الحقل :attribute نصا من نوع JSON.',
    'max'                  => [
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute مساوية أو أصغر لـ :max.',
        'file'    => 'يجب أن لا يتجاوز حجم الملف :attribute :max كيلوبايت',
        'string'  => 'يجب أن لا يتجاوز طول النّص :attribute :max حروفٍ/حرفًا',
        'array'   => 'يجب أن لا يحتوي الحقل :attribute على أكثر من :max عناصر/عنصر.',
    ],
    'mimes'                => 'يجب أن يكون الحقل ملفًا من نوع : :values.',
    'mimetypes'            => 'يجب أن يكون الحقل ملفًا من نوع : :values.',
    'min'                  => [
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute مساوية أو أكبر لـ :min.',
        'file'    => 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت',
        'string'  => 'يجب أن يكون طول النص :attribute على الأقل :min حروفٍ/حرفًا',
        'array'   => 'يجب أن يحتوي الحقل :attribute على الأقل على :min عُنصرًا/عناصر',
    ],
    'not_in'               => 'الحقل :attribute لاغٍ',
    'numeric'              => 'يجب على الحقل :attribute أن يكون رقمًا',
    'present'              => 'يجب تقديم الحقل :attribute',
    'regex'                => 'صيغة الحقل :attribute .غير صحيحة',
    'not_empty'             => 'الحقل :attribute لا يجب تركة فارغاً أو بقيمة غير صحيحة.',
    'required'             => 'الحقل :attribute مطلوب.',
    'required_if'          => 'الحقل :attribute مطلوب في حال ما إذا كان :other يساوي :value.',
    'required_unless'      => 'الحقل :attribute مطلوب في حال ما لم يكن :other يساوي :values.',
    'required_with'        => 'الحقل :attribute إذا توفّر :values.',
    'required_with_all'    => 'الحقل :attribute إذا توفّر :values.',
    'required_without'     => 'الحقل :attribute إذا لم يتوفّر :values.',
    'required_without_all' => 'الحقل :attribute إذا لم يتوفّر :values.',
    'same'                 => 'يجب أن يتطابق الحقل :attribute مع :other',
    'size'                 => [
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute مساوية لـ :size',
        'file'    => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت',
        'string'  => 'يجب أن يحتوي النص :attribute على :size حروفٍ/حرفًا بالظبط',
        'array'   => 'يجب أن يحتوي الحقل :attribute على :size عنصرٍ/عناصر بالظبط',
    ],
    'string'               => 'يجب أن يكون الحقل :attribute نصآ.',
    'timezone'             => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا',
    'unique'               => 'قيمة الحقل :attribute مُستخدمة من قبل',
    'uploaded'             => 'فشل في تحميل الـ :attribute',
    'url'                  => 'صيغة الرابط :attribute غير صحيحة',
    'check_order'                  => 'لقد تم سحب جميع الحمولات لهذة الطلبية',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [

        'name'                  => 'الاسم',
        'username'              => 'اسم المُستخدم',
        'email'                 => 'البريد الالكتروني',
        'first_name'            => 'الاسم',
        'last_name'             => 'اسم العائلة',
        'password'              => 'كلمة  المرو',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'city'                  => 'المدينة',
        'country'               => 'الدولة',
        'address'               => 'العنوان',
        'phone'                 => 'الهاتف',
        'title'                 => 'العنوان',
        'content'               => 'المُحتوى',
        'text'                  => 'المُحتوى',
        'description'           => 'الوصف',
        'quantities'            => 'الكميه',
        'price'                         => 'السعر',
        'category'                      => 'التصنيف',
        'sub'                           => 'التصنيف الفرعى',
        'profile'                       => 'رابط صفحتى',
        'lang'					        => 'اللغة',
        'mobile'					    => 'جوال',
        'date_birth'					=> 'تاريخ الميلاد',
        'cars'					        => 'عدد الحمولات المتفق عليها',
        'type'					        => 'النوع',
        'time_entry'					=> 'وقت الدخول',
        'time_move'					    => 'وقت الخروج',
        'arrival_time'					=> 'وقت الوصول',
        'driver'					    => 'السائق',
        'car_number'					=> 'رقم السيارة ',
        'driving_license_expire_date'	=> 'إنتهاء رخصة السائق',
        'car_license_expiry'			=> 'إنتهاء رخصة السيارة',
        'id_scan'                       => 'صورة الهوية',
        'customer'                      => 'العميل ',
        'destination'                   => 'المكان',
        'trans_price'                   => ' قيمة النقل ',
        'capacity'                      => 'حمولة العربية',
        'license_image'					=> 'رخصة السيارة ',
        'LogBook'                       => 'قم السجل ',
        'notes'                         =>  'لاحظات   ',
        'sales_man'                     => ' لمسئول عن العميل ' ,
        'governorate'                   => 'لمحافظة  ',
        'city'                          =>   'المركز  ',
        'distance'                      => 'المسافة  ',
        'area'                          =>  'المساحة  ' ,   
        'crop '                         =>  'المحصول  ' ,
        'unit'                          => 'الوحدة  ',
        'discount '                     =>'الخصم  ',
        'driver_number '                =>  'رقم السائق  ',
        'trans_provider'        => 'سم مقاول النقل  ',
        'trans_cost'            => 'تكلفة الحمولة  ' ,
        'aging'                 => 'التعتيق  ', 
        'load_date'             => 'تاريخ التحميل  ',
        'product'               => 'اسم الصنف  ',
        'Payment'               => 'ستحقاق باق المبلغ   ' ,
        'payment_type'          =>'نوع الدفع  ',
        'Sales'                 => 'سئول البيع  ',
        'delevery_location'     => 'كان التوصيل  ', 
        'delevery_requested'    =>'لوب التوصيل  ',
        'packing'               => ' وع التعبئة   ',
        'supply_order'          =>  'مر توريد  ',
        'customer_representative' =>' ممثل العميل  ',
        'amount'  =>'الكمية',
        'transportation' =>'تكلفة النقل ',
        'place' =>'المكان  ',
        'company_name' =>'سم الشركة  ',
        'load' =>'حمولة العربيات  ',

    ],

];
