<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use function PHPSTORM_META\type;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable= ['client_id','subcategory_id','table_id','type','status','cancel_reason'];
    // type
    static function type()
    {
        $array=
            [
                0 => __('orders.type.floor'), // الصالة
                1 => __('orders.type.delivery'), // ديليفري
                2 => __('orders.type.take_away'), // تيك اوي
            ];
        return $array;
    }
    // get type
    public function getTypeeAttribute()
    {
        return self::type()[$this->type];
    }
    // status
    static function status()
    {
        $array=
            [
                0 => __('orders.status.orderd'), // تم الطلب
                1 => __('orders.status.prepared'), // تم التجهيز
                2 => __('orders.status.closed'), //  تم إغلاق الطلب
                3 => __('orders.status.payment'), //  تم الدفع
                4 => __('orders.status.canceled'), //  تم الإلغاء
            ];
        return $array;
    }
    // get status
    public function getStatussAttribute()
    {
        return self::status()[$this->status];
    }
    // get total price
    public function getTotalPriceAttribute()
    {
        return $this->products->sum('price');
    }
    // category
    public function category()
    {
    	return $this->belongsTo(Ccategory::class);
    }
    // products
    public function products()
    {
    	return $this->belongsToMany(Product::class);
    }
    // payment
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
