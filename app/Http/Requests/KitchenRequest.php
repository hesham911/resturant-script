<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\EnoughSuppliesRule;

class KitchenRequest extends FormRequest
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
            'group'=> new EnoughSuppliesRule,
            'user_id'=>'required',
        ];
    }
    public function attributes()
    {
        return [
            'group.*.material_id'=>__('kitchenrequests.material_id'),
            'group.*.quantity'=>__('kitchenrequests.quantity'),
            'user_id'=>__('kitchenrequests.user_id'),
        ];
    }
}
