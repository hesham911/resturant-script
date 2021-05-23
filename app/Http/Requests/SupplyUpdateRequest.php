<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplyUpdateRequest extends FormRequest
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
            'quantity'=>'required|numeric|max:999999',
            'price'=>'required|numeric|max:999999',
            'Supplier_name'=>'required',
            'expiry_date'=>'required',
            'employee_id'=>'required',
            'bill_number'=>'required|numeric|max:999999',
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
            'employee_id'=>__('supplies.employee_id'),
            'bill_number'=>__('supplies.bill_number'),
        ];
    }
}
