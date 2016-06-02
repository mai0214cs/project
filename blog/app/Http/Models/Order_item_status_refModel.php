<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Order_item_status_refModel extends Model
{
    protected $table = 'order_item_status_ref';
    public function getOrderItems(){
        return $this->hasMany(getModel('order_items'), 'status');
    }
}
