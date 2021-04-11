<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Table extends Model
{  
    use SoftDeletes;

    public function floor(){
        return $this->belongsTo(Floor::class);
    }
}
