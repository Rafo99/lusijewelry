<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['name', 'product_id', 'last_name', 'email_phone', 'address', 'sent', 'message'];

}
