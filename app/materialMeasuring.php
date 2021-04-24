<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialMeasuring extends Model
{
    use SoftDeletes;
    public function supplies (){
        return $this->hasMany(Supply::class , 'measuring_id');
    }
}
