<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supply extends Model
{
    use SoftDeletes;

    public function measurings (){
        return $this->belongsTo(MaterialMeasuring::class , 'measuring_id');
    }
}
