<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = ['product_id', 'order_id', 'qty', 'price'];
    public $timestamps = false;

    public function product()
    {
        return $this->hasOne('App\Product', 'id', 'product_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
