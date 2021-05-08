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
            'group.*.material_id'=>'required',
            'group.*.quantity'=>'required|numeric|min:1|max:7',
            'group.*.price'=>'required|numeric|min:1|max:7',
            'group.*.Supplier_name'=>'required',
            'group.*.expiry_date'=>'required',
            'employee_id'=>'required',
            'bill_number'=>'required|numeric|min:1|max:7',
        ];
    }

    public function attributes()
    {
        return [
            'group.*.material_id'=>__('supplies.material_id'),
            'group.*.quantity'=>__('supplies.quantity'),
            'group.*.price'=>__('supplies.price'),
            'group.*.Supplier_name'=>__('supplies.Supplier_name'),
            'group.*.expiry_date'=>__('supplies.expiry_date'),
            'employee_id'=>__('supplies.employee_id'),
            'bill_number'=>__('supplies.bill_number'),
        ];
    }
}
