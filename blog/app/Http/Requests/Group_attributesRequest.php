<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Group_attributesRequest extends Request
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
            'status'=>'required|in:Show,Hide',
            'type'=>'required|in:select,checkbox,radio,color,location,text',
            'order'=>'required|integer',
            'name'=>'required'
        ];
    }
}
