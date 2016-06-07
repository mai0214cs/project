<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductsRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'price_import'      => 'required|integer',
            'price_sale'        => 'required|integer',
            'price_promotion'   => 'required|integer',
            'included_VAT'      => 'required|in:Yes,No',
            'quantity'          => 'required|integer',
            'manager_inventory' => 'required|in:Yes,No',
            'seller'            => 'required|in:Yes,No'
        ];
    }
}
