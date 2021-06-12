<?php

namespace App;

use App\User as BasicUser;
use Illuminate\Database\Eloquent\SoftDeletes;
 
class Client extends BasicUser
{
   	use SoftDeletes;


   	public function zones()
    {
        return $this->belongsToMany(Zone::class,'client_zone')->withPivot(['id','address'])->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}

