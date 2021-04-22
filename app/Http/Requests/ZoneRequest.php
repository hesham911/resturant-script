<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZoneRequest extends FormRequest
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
            'name'  =>   'required|string|min:2',
            'price' =>   'required|numeric|min:0|not_in:0',
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'name'      =>__('geo.zones.name'),
            'price'     =>__('geo.zones.price'),
        ];
    }
}
