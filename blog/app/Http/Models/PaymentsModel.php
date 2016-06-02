<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentsModel extends Model
{
    protected  $table = 'payments';
    public function getOrders(){
        return $this->hasMany(getModel('orders'), 'id_payment');
    }
    public function getInvoices(){
        return $this->hasMany(getModel('invoices'), 'id_payment');
    }
}
