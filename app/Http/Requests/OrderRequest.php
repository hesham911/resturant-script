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
            'user_id' =>   'required',
            'category_id' =>   'required',
            'type' =>   'required|numeric',
            'group_a' =>'required',
            'group_a.*.quantity' =>   'required|numeric',
            'group_a.*.product_id' =>   'required|numeric',
            'table_id'   =>'required_if:type,==,0',
            'client_id'   =>'required_if:type,==,1',
            'client_phone'  =>'required_if:type,==,1',
            'client_zone'  =>'required_if:type,==,1',
            //'products'   =>'required',
        ];
    }
    public function attributes()
    {
        return [
            'client_id'      =>__('orders.client_id'),
            'category_id'     =>__('orders.category_id'),
            'table_id'     =>__('orders.table_id'),
            'type'     =>__('orders.order_type'),
            'products'     =>__('orders.products'),
        ];
    }
}
