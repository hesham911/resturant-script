<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'  =>   'required|min:2',
            'subcategory_id' =>   'required',
            'price' =>   'required|numeric|gt:0',
            'group'            =>   'array',
            'group.*.material_id'        => 'required',
            'group.*.required_quantity'  => 'required|numeric',
        ];
        // $ProductManufactures = [
        //     'group.*.material_id'=>'required',
        //     'group.*.required_quantity'=>'required|numeric|max:999999',
        // ];
    }
    public function attributes()
    {
        return [
            'name'      =>__('products.name'),
            'subcategory_id'     =>__('products.subcategory_id'),
            'price'     =>__('products.price'),
        ];
    }
}
