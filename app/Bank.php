<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Bank extends Model
{
    use SoftDeletes;
   protected $fillable=['name','opening_balance','notes','type'];

    static function type()
    {
        $array=
            [
                0         => 'كاشير',
                1         => 'محاسب',

            ];
        return $array;
    }
    // get type
    public function getTypeeAttribute()
    {
        return self::type()[$this->type];
    }

    public function workPeriods()
    {
        return $this->hasMany(WorkPeriod::class,'bank_id');
    }

    public function bankTransactions()
    {
        return $this->hasMany(BankTransaction::class,'bank_id');
    }

    public function ScopeGetBankFromId(Builder $query,$id){
        return $query->findOrFail($id);
    }

    public function scopeGetBankCashierNotInWork( $query)
    {
        return $query->where('type','0')->doesntHave('workPeriods')
            ->orWhereHas('workPeriods',function (Builder $q){
            $q->where('status','!=',1);
        });
    }
}
