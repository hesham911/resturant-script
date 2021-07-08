<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankTransaction extends Model
{
    use SoftDeletes;

    protected $fillable=['bank_id','user_id','notes','amount','balance'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class,'bank_id');
    }

    public function scopeGetLastBalance($query,$id)
    {
      return  (double) $query->where('bank_id',$id)->orderBy('id','DESC')->first()->balance;
    }

    public function scopeSumBalance($query,$amount,$id)
    {
        return   $this->scopeGetLastBalance($query,$id) + $amount;
    }

    public function scopeSubBalance($query,$amount,$id)
    {
        return   $this->scopeGetLastBalance($query,$id) - $amount;
    }
}
