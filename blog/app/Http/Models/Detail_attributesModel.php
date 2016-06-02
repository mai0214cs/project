<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Detail_attributesModel extends Model
{
    protected $table = 'detail_attributes';
    public function getProducts() {
        return $this->belongsTo(getModel('products'), 'id_product');
    }
    public function getListAttributes(){
        return $this->belongsTo(getModel('list_attributes'), 'id_list');
    }
}
