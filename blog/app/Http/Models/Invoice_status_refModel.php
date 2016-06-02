<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice_status_refModel extends Model
{
    protected $table = 'invoice_status_ref';
    public function getInvoices() {
        return $this->hasMany(getModel('invoices'), 'status');
    }
}
