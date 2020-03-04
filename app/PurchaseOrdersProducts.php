<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrdersProducts extends Model
{
    public function PurchaseOrders(){
        return $this->belongsTo('App\PurchaseOrders','purchase_orders_id');
    }
}
