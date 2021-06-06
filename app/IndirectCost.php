<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndirectCost extends Model
{
    use SoftDeletes;
    /**
     * @var array
     */
    protected $fillable=['name'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function indirectexpenses()
    {
        return $this->hasMany(IndirectExpense::class,'indirect_cost_id');
    }
}
