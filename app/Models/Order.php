<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['client_name', 'price'];


    public function items()
    {
        return $this->hasMany('App\Models\OrderItem', 'order_id', 'id');
    }
}
