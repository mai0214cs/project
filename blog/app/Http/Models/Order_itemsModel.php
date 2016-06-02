<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Order_itemsModel extends Model
{
    protected $table = 'order_items';
    public function getProducts() {
        return $this->belongsTo(getModel('products'), 'id_product');
    }
    public function getOrderItemStatus(){
        return $this->belongsTo(getModel('order_item_status_ref'), 'status');
    }
    public function getOrders(){
        return $this->belongsTo('orders', 'id_order');
    }
}
