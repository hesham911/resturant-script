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
            'group.*.quantity'=>'required|numeric|max:999999',
            'group.*.price'=>'required|numeric|max:999999',
            'Supplier_name'=>'required',
            'group.*.expiry_date'=>'nullable',
            'user_id'=>'required',
            'bill_number'=>'required|numeric|max:999999',
        ];
    }

    public function attributes()
    {
        return [
            'group.*.material_id'=>__('supplies.material_id'),
            'group.*.quantity'=>__('supplies.quantity'),
            'group.*.price'=>__('supplies.price'),
            'Supplier_name'=>__('supplies.Supplier_name'),
            'group.*.expiry_date'=>__('supplies.expiry_date'),
            'user_id'=>__('supplies.user_id'),
            'bill_number'=>__('supplies.bill_number'),
        ];
    }
}
