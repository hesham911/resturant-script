<?php

namespace App;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


class DamagedMaterial extends Model
{
    use SoftDeletes;

    protected $fillable  = ['supply_id','price','quantity','user_id'];

    public function material(){
        return $this->belongsTo(Material::class)->withTrashed();
    }

    public function user (){
        return $this->belongsTo(User::class);
    }

    
}
