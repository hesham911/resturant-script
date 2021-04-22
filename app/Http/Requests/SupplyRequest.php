<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'material_id'=>'required',
            'quantity'=>'required',
            'price'=>'required',
            'Supplier_name'=>'required',
            'expiry_date'=>'required',
        ];
    }

    public function attributes()
    {
        return [
            'material_id'=>__('supplies.material_id'),
            'quantity'=>__('supplies.quantity'),
            'price'=>__('supplies.price'),
            'Supplier_name'=>__('supplies.Supplier_name'),
            'expiry_date'=>__('supplies.expiry_date'),
        ];
    }
}
