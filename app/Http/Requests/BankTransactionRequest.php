<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankTransactionRequest extends FormRequest
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
            'fromBank'          => 'required',
            'toBank'            => 'required|different:fromBank',
            'amount'            => 'required|numeric|different:fromBank',
            'notes'             => '',
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'fromBank'          =>__('accounting.transactions.fromBank'),
            'toBank'            =>__('accounting.transactions.toBank'),
            'amount'            =>__('accounting.transactions.amount'),
            'notes'             =>__('accounting.transactions.notes'),
        ];
    }
}
