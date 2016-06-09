<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class Users1 extends Authenticatable
{
    use Billable;
}
