<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'client_id'  =>   'required',
            'subcategory_id' =>   'required',
            'type' =>   'required|numeric',
            'table_id'   =>'required_if:type,==,0',
            'table_id'   =>'required',
        ];
    }
    public function attributes()
    {
        return [
            'client_id'      =>__('orders.client_id'),
            'subcategory_id'     =>__('orders.subcategory_id'),
            'table_id'     =>__('orders.table_id'),
            'type'     =>__('orders.order_type'),
        ];
    }
}