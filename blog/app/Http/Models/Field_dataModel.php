<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Field_dataModel extends Model
{
    protected $table = 'field_data';
    public function getPage(){
        return $this->belongsTo(getModel('page'), 'id_page');
    }
}
