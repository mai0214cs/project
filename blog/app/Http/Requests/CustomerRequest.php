<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CustomerRequest extends Request
{
    public function authorize()
    {
        return TRUE;
    }

    public function rules()
    {
        return [
            'isperson'  =>'required|in:Yes,No',
            'gender'    =>'required|in:male,female',
            'fullname'  =>'required',
            'email'     =>'email',
            'username'  =>'unique:customer,username'
        ];
    }
}
