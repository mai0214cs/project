<?php
function getModel($name){
    return '\App\Http\Models\\'.ucfirst($name).'Model';
}
