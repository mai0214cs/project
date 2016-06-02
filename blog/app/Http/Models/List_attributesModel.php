<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class List_attributesModel extends Model
{
    protected $table = 'list_attributes';
    public function getDetailAttribute(){
        return $this->hasMany(getModel('detail_attributes'), 'id_list');
    }
    public function getGroupAttribute(){
       return $this->belongsTo(getModel('group_attributes'), 'id_group');
    }
}
