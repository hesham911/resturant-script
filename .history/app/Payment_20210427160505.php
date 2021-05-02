<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    // ord
    public function payment()
    {
        return $this->belongsTo(Order::class);
    }
}
