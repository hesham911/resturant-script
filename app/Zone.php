<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zone extends Model
{
    use SoftDeletes;

    protected $fillable= ['name','price'];


    public function clients()
    {
        return $this->belongsToMany(Client::class,'client_zone')
            ->withPivot('address')->withTimestamps();
    }
}
