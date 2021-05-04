<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KitchenRequest extends Model
{
    use SoftDeletes;

    protected $fillable=[
        'material_id',
        'quantity',
        'status',
        'employee_id',
    ];

    public function material(){
        return $this->belongsTo(Material::class);
    }

    public function employee (){
        return $this->belongsTo(Employee::class);
    }

    public function status(){
        return [
            1=>'منتهي',
            0=>'غير منتهي',
        ];
    }

    public function supplies(){
        return $this->belongsToMany(Supply::class, 'request_supply'  ,'request_id' , 'supply_id');
    }

}
