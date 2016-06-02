<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Group_attributesModel extends Model
{
    protected $table = 'group_attributes';
    public function getListAttributes(){
        return $this->hasMany(getModel('list_attributes'), 'id_group');
    }
    
}
