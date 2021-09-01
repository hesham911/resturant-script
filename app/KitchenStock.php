<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KitchenStock extends Model
{
    protected $fillable = [
        'quantity',
        'material_id',
    ];

    public function material(){
        return $this->belongsTo(Material::class)->withTrashed();
    }
}
