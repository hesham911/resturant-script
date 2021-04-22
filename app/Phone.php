<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
   protected $fillable=['number'];

   public function user()
   {
       return $this->belongsTo(User::class,'user_id');
   }
}
