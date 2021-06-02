<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkPeriod extends Model
{
    use SoftDeletes;

    protected $fillable=['user_id','bank_id','opening_balance','close_balance'];

    public function employee()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class,'bank_id');
    }
}
