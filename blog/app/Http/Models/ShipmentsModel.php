<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentsModel extends Model
{
    protected $table = 'shipments';
    public function getShipmentRef(){
        return $this->belongsTo(getModel('shipment_ref'), 'status');
    }
    public function getOrders(){
        return $this->belongsTo(getModel('orders'), 'id_order');
    }
    public function getInvoices(){
        return $this->belongsTo(getModel('invoices'), 'invoice_number');
    }
}
