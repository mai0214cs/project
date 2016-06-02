<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Order_status_refModel extends Model
{
    protected $table = 'order_status_ref';
    public function getOrders(){
        return $this->hasMany(getModel('orders'), 'status');
    }
}

