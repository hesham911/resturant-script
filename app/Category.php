<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $fillable  = ['name'];
    use SoftDeletes;

    public function subcategories ()
    {
        return $this->hasMany(Subcategory::class)->withTrashed();
    }
}
