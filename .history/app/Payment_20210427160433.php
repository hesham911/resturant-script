<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    // payment
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
