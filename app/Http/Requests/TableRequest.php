<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TableRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'floor_id'=>'required',
        ],[
            'name'=>__('categories.name'),
            'floor_id'=>__('categories.floor_id'),
            'status'=>__('categories.status'),
        ];
    }
}
