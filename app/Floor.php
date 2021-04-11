<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Floor extends Model
{
    use SoftDeletes;

    public function tables (){
        return $this->hasMany(Table::class);
    }
}
