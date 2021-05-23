<?php

namespace App;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


class DamagedMaterial extends Model
{
    use SoftDeletes;

    protected $fillable  = ['supply_id','price','quantity'];

    public function material(){
        return $this->belongsTo(Material::class);
    }

    public function employee (){
        return $this->belongsTo(Employee::class);
    }

    
}
