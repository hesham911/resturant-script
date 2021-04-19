<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'value'=>'required',
            'active'=>'required',
        ];
    }

    public function attributes()
    {
        return [
            'name'=>__('settings.name'),
            'value'=>__('settings.value'),
            'active'=>__('settings.active'),
        ];
    }
}
