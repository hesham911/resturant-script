<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialMeasuring extends Model
{
    use SoftDeletes;
    public function materials (){
        return $this->hasMany(Material::class , 'measuring_id')->withTrashed();
    }
}
