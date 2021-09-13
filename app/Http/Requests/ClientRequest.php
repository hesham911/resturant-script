<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'group_a'            =>   'array',
            'group_b'            =>   'array',
            'group_b.*.address'  =>   'required|string ',
            'group_b.*.zone'     =>   'required',
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'name'              =>  __('users.clients.name'),
            'group_a'           =>  __('users.clients.phone'),
            'group_b'           =>  __('users.clients.address'),
            'group_b.*.address' =>  __('users.clients.address'),
            'group_b.*.zone'    =>  __('users.clients.zone'),
        ];
    }
}
