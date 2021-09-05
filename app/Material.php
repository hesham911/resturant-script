<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Material extends Model
{
    use SoftDeletes;
    protected $fillable = ['name','expiry_date','measuring_id'];

    public function measuring (){
        return $this->belongsTo(MaterialMeasuring::class , 'measuring_id');
    }

    public function supplies (){
        return $this->hasMany(Supply::class);
    }

    public function availableSupplies (){
        return $this->hasMany(Supply::class)
            ->where('status',0)
            ->where('quantity' , '>' , 0);
    } 

    public function ProductManufacture (){
        return $this->hasMany(ProductManufacture::class);
    }

    public function warehousestock(){
        return $this->hasOne(WarehouseStock::class);
    }

    public function scopeNotRelatedMaterials($query , $relatedMaterials)
    {
        return $query->whereNotIn('id',$relatedMaterials);
    }

    public function scopeMaterialSearch($query , $search,$relatedMaterials){
        return $query->notRelatedMaterials($relatedMaterials)->where('name','LIKE','%'.$search.'%');
    }

    public function damagedMaterials (){
        return $this->hasMany(DamagedMaterial::class)->withTrashed();
    }
}
