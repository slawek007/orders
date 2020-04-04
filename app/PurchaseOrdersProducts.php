<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrdersProducts extends Model
{
    protected $guarded=[];

    public function PurchaseOrders(){
        return $this->belongsTo('App\PurchaseOrders','purchase_orders_id');
    }


    public function productsDetail(){
        return $this->belongsTo('App\Products','products_id');
    }
}
