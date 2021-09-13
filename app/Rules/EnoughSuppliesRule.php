<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Material;


class EnoughSuppliesRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach ($value as  $kitchen_request) {
            $material = Material::find($kitchen_request['material_id']);
            $supplies = $material->supplies->where('status',false);
            if ($supplies->sum('quantity')-$supplies->sum('used_amount') < $kitchen_request['quantity'] ) {
                return false ;
            }
        }
        return true ;   
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ' الكمية المطلوبة أكبر من المخزون ';
    }
}
