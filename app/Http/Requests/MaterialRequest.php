<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialRequest extends FormRequest
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
            'name'=>'required',
            'measuring_id'=>'required',
        ];
    }

    public function attributes()
    {
        return [
            'name'=>__('materials.name'),
            'measuring_id'=>__('materials.measuring_id'),
        ];
    }
}