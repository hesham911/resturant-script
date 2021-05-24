<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use function PHPSTORM_META\type;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable= ['client_id','client_phone'',,'user_id','category_id','table_id',
    'type','status','cancel_reason'];
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
               // 1 => __('orders.status.prepared'), // تم التجهيز
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

        $total=0;
        foreach($this->products as $product)
        {
            $for_one=$product->price * $product->pivot->quantity;
            $total +=$for_one;
        }
        return $total;
        //return $this->products->sum('price');
    }

    public function user (){
        return $this->belongsTo(User::class);
    }

    // category
    public function category()
    {
    	return $this->belongsTo(Category::class);
    }
    // products
    public function products()
    {
    	return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
    // payment
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function requests()
    {
    	return $this->belongsToMany(KitchenRequest::class , 'order_request' , 'order_id' ,'request_id' );
    }
}
