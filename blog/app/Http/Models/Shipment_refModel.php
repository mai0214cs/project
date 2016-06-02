<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment_refModel extends Model
{
    protected $table = 'shipment_ref';
    public function getShipments() {
        return $this->hasMany(getModel('shipments'), 'status');
    }
}
