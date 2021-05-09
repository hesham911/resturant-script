<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'group.*.quantity'=>'required|numeric|min:1|max:7',
            'employee_id'=>'required',
        ];
    }
    public function attributes()
    {
        return [
            'group.*.material_id'=>__('kitchenrequests.material_id'),
            'group.*.quantity'=>__('kitchenrequests.quantity'),
            'employee_id'=>__('kitchenrequests.employee_id'),
        ];
    }
}
