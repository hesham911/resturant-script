<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\DB;
use function PHPSTORM_META\type;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable= ['client_id','client_phone','client_zone','user_id','category_id','table_id',
    'type','status','cancel_reason' , 'delevery_id'];
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

    // Full Address
    public function getFullAddressAttribute()
    {
        $add=DB::table('client_zone')->where('id',$this->client_zone)->first();
        $zone=Zone::where('id',$add->zone_id)->first()->name;
        return $zone.'-'.$add->address;
    }
    //Delivery Price
    public function getDeliveryPriceAttribute()
    {
        $add=DB::table('client_zone')->where('id',$this->client_zone)->first();
        $zone=Zone::where('id',$add->zone_id)->first();
        return $zone->price;
    }

    //Delivery Phone
    public function getDeliveryPhoneAttribute()
    {
        $phone=Phone::where('id',$this->client_phone)->first()->number;
        return $phone;
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
        if ($this->type == 1)
        {
            $delev=$this->delivery_price;
            $total+=$delev;
        }
        return $total;
        //return $this->products->sum('price');
    }

    public function user (){
        return $this->belongsTo(User::class);
    }


    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    // category
    public function category()
    {
    	return $this->belongsTo(Category::class)->withTrashed();
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
