<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{
    protected $table = 'products';
    public function getOrderItems() {
        return $this->hasMany(getModel('order_items'), 'id_product');
    }
    public function getDetailAttributes(){
        return $this->hasMany(getModel('detail_attributes'), 'id_product');
    }
}
