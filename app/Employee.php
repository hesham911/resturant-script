<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;


    public function User()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
