<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class InvoicesModel extends Model
{
    protected $table = 'invoices';
    public function getInvoiceStatusRef(){
        return $this->belongsTo(getModel('invoice_status_ref'), 'status');
    }
    public function getPayment() {
        return $this->belongsTo(getModel('payments'), 'id_payment');
    }
    public function getOrders(){
        return $this->belongsTo(getModel('orders'), 'id_order');
    }
    public function getShipments(){
        return $this->hasMany(getModel('shipments'), 'invoice_number');
    }
}
