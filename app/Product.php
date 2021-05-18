<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Material;

class Product extends Model
{
    use SoftDeletes;


    
    protected $fillable= ['name','subcategory_id','type','price'];
    // type
    static function type()
    {
        $array=
            [
                1 => __('products.typee.main'), // طبق رئيسي
                2 => __('products.typee.add'), //  إضافات
            ];
        return $array;
    }
    // get type
    public function getTypeeAttribute()
    {
        return self::type()[$this->type];
    }
    // subcategory
    public function subcategory()
    {
    	return $this->belongsTo(Subcategory::class);
    }
    // orders
    public function orders()
    {
    	return $this->belongsToMany(Order::class);
    }

    public function ProductManufactures()
    {
    	return $this->hasMany(ProductManufacture::class);
    }
    
}
