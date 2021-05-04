<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductManufactureRequest extends FormRequest
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
            'product_id'=>'required',
            'required_quantity'=>'required',
            'waste_percentage'=>'required',
        ];
    }
    public function attributes()
    {
        return [
            'material_id'=>__('productmanufactures.material_id'),
            'product_id'=>__('productmanufactures.product_id'),
            'required_quantity'=>__('productmanufactures.required_quantity'),
            'waste_percentage'=>__('productmanufactures.waste_percentage'),
        ];
    }
}
