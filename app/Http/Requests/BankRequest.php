<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankRequest extends FormRequest
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
            'name'               =>   'required|string|min:2',
            'opening_balance'    =>   'required|numeric|min:0|not_in:0',
            'notes'              =>   '',
            'type'               =>   'required',
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'name'              =>__('accounting.banks.name'),
            'opening_balance'   =>__('accounting.banks.balance'),
            'notes'             =>__('accounting.banks.notes'),
            'type'              =>__('accounting.banks.types_bank'),
        ];
    }
}
