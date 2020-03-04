<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $guarded = [];

    public function purchaseOrders(){
        return $this->hasMany('App\PurchaseOrders')->take(10);
    }
}
