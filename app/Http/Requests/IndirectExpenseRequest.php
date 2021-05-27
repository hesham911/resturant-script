<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndirectExpenseRequest extends FormRequest
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
            'costs'                 =>   'required|numeric',
            'daterangepicker'       =>   'required|string',
            'amount'                =>   'required|numeric|min:0|not_in:0',
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'costs'                 =>__('accounting.indirect-expenses.cost'),
            'daterangepicker'       =>__('accounting.indirect-expenses.daterangepicker'),
            'amount'                =>__('accounting.indirect-expenses.amount'),
        ];
    }
}
