<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    protected $fillable  = ['name','category_id'];
    use SoftDeletes;

    public function category (){
    	return $this->belongsTo(Category::class);
    }
}
