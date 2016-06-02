<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersModel extends Model
{
    protected $table = 'orders';
    public function getOrderItems(){
        return $this->hasMany(getModel('order_items'), 'id_order');
    }
    public function getCustomers(){
        return $this->belongsTo(getModel('customers'), 'id_customer');
    }
    public function getOrderStatusRef(){
        return $this->belongsTo(getModel('order_status_ref'), 'status');
    }
    public function getShipments(){
        return $this->hasMany(getModel('shipments'), 'id_order');
    }
    public function getInvoices(){
        return $this->hasMany(getModel('invoices'), 'id_order');
    }
    public function getPayments(){
        return $this->belongsTo(getModel('payments'), 'id_payment');
    }
}
