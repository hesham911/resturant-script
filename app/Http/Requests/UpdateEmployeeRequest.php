<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateEmployeeRequest extends FormRequest
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
       $user = $this->employee->user ;
       $unique_number = Rule::unique('phones','number');
       $unique_number->where(function ($query)use ($user){
           return $query->whereNotIn('id',$user->phones->pluck('id')->toArray());

       });
        return [
            'name'               =>   'required|string|min:2',
            'email'              =>   [
                'email',
                 Rule::unique('users','email')->ignore($user)
            ],
            'type_employees'     =>   'required|numeric|',
            'status_employees'   =>   'numeric|',
            'group_a'            =>   'array',
            'group_a.*.*'        =>   [
                'numeric',
                'digits:11',
                $unique_number
            ]

        ];
    }
    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'name'              =>     __('users.employees.name'),
            'email'             =>     __('users.employees.email'),
            'type_employees'    =>     __('users.employees.types_employees'),
            'status_employees'  =>     __('users.employees.status'),
            'group_a'           =>     __('users.employees.phone'),
            'group_a.*.*'       =>     __('users.employees.phone'),
        ];
    }
}
