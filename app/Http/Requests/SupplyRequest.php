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
        ];
    }

    public function attributes()
    {
        return [
            'material_id'=>__('settings.material_id'),
            'quantity'=>__('settings.quantity'),
            'price'=>__('settings.price'),
            'Supplier_name'=>__('settings.Supplier_name'),
        ];
    }
}
