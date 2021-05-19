<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supply extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'quantity',
        'price',
        'Supplier_name',
        'expiry_date',
        'employee_id',
        'material_id',
        'bill_number',
    ];

    public function material (){
        return $this->belongsTo(Material::class);
    }

    public function employee (){
        return $this->belongsTo(Employee::class);
    }

    public function kitchen_requests(){
        return $this->belongsToMany(KitchenRequest::class, 'request_supply'  , 'supply_id' ,'request_id');
    }
}
