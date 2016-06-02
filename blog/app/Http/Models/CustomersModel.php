<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CustomersModel extends Model
{
    protected $table = 'customers';
    public function getOrders(){
        return $this->hasMany(getModel('orders'), 'id_customer');
    }
    
}
