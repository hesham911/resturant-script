<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductManufacture extends Model
{
    use SoftDeletes;
    
    protected $fillable =[
        'material_id',
        'product_id',
        'required_quantity',
        'waste_percentage',
    ];

    protected $table = 'products_manufactures';

    public function product (){
        return $this->belongsTo(Product::class);
    }

    public function material (){
        return $this->belongsTo(Material::class);
    }

}
