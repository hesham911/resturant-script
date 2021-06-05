<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkPeriod extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates=[
        'created_at',
        'updated_at',
        'deleted_at',
        'date_start',
        'date_end'
    ];
    /**
     * @var array
     */
    protected $fillable=[
        'user_id',
        'bank_id',
        'opening_balance',
        'close_balance',
        'date_start',
        'date_end',
        'status'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bank()
    {
        return $this->belongsTo(Bank::class,'bank_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany(Payment::class,'work_period_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function indirectexpenses()
    {
        return $this->hasMany(IndirectExpense::class,'work_period_id');
    }

    /**
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeGetAllIncome($query, $id)
    {
       $work = $this->findOrFail($id);
       return $work->payments;
    }

    /**
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeGetAllOutCome($query, $id)
    {
        $work = $this->findOrFail($id);
        return $work->indirectexpenses;
    }

    /**
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeGetCloseBalance($query, $id)
    {
        return $this->getAllIncome($id)->sum('total_price') - $this->getAllOutCome($id)->sum('amount');
    }
}
