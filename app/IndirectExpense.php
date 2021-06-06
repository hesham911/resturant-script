<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndirectExpense extends Model
{
    use SoftDeletes;
    /**
     * @var array
     */
    protected $fillable=['indirect_cost_id','date_from','date_to','amount'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function indirectcost()
    {
        return $this->belongsTo(IndirectCost::class,'indirect_cost_id');
    }
<<<<<<< HEAD
=======

    public function workperiod()
    {
        return $this->belongsTo(WorkPeriod::class,'work_period_id');
    }
>>>>>>> 7612fef92bfa57ada1ac75b1c55badb25eaa364c
}
