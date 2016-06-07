<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PageModel extends Model
{
    protected $table = 'page';
    public function page(){
        return $this->belongsTo(getModel('page'), 'id_page');
    }
    public function products(){
        return $this->hasOne(getModel('products'), 'id_page');
    }
}
