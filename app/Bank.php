<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use SoftDeletes;
   protected $fillable=['name','opening_balance','notes'];

    public function workPeriods()
    {
        return $this->hasMany(WorkPeriod::class,'bank_id');
    }

    public function bankTransactions()
    {
        return $this->hasMany(BankTransaction::class,'bank_id');
    }

    public function ScopeGetBankFromId($query,$id){
        return $query->findOrFail($id);
    }
}
