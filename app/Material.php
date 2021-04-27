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
}
