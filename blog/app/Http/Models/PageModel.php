<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PageModel extends Model
{
    protected $table = 'page';
    public function getCategory(){
        return $this->hasOne(getModel('page'), 'id_page');
    }
    public function getProducts(){
        return $this->hasOne(getModel('products'), 'id_page');
    }
}
