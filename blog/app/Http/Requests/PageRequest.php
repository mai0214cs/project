<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PageRequest extends Request {
    public function authorize() {
        return true;
    }

    public function rules() {
        $input = \Request::all();
        $listpage = array('home','news_category','news_list','product_category','product_list');
        switch ($this->method()) {
            case 'POST':
                return [
                    'title' => 'required',
                    'alias' => 'required|min:5|unique:page,alias',
                    'type'  => 'in:'.  implode(',', $listpage),
                    'orderby'=> 'integer',
                    'status' => 'in:Yes,No'
                ];
            case 'PUT':
                return [
                    'title' => 'required',
                    'alias' => 'required|min:5|unique:page,alias,'.$input['id'],
                    'type'  => 'in:'.  implode(',', $listpage),
                    'orderby'=> 'integer',
                    'status' => 'in:Yes,No'
                ];
        }
    }

}
