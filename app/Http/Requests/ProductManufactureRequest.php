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
            'group.*.material_id'=>'required',
            'product_id'=>'required',
            'group.*.required_quantity'=>'required',
            'group.*.waste_percentage'=>'required',
        ];
    }
    public function attributes()
    {
        return [
            'group.*.material_id'=>__('productmanufactures.material_id'),
            'product_id'=>__('productmanufactures.product_id'),
            'group.*.required_quantity'=>__('productmanufactures.required_quantity'),
            'group.*.waste_percentage'=>__('productmanufactures.waste_percentage'),
        ];
    }
}
