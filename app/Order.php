<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable = array('client_id','subcategory_id','table_id','type');
    public static function validate($input) {

        $rules = array(
            'client_id'=> [
                'required',
            ],
            'subcategory_id'=> [
                'required',
            ],
            'table_id'=> [
                'required',
            ],
            'type'=> [
                'required',
                'numeric'
            ],
        );
        return validator($input, $rules);
    }
}
