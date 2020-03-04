<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrders extends Model
{
    protected $table = 'purchase_orders';
    public function customer(){
        return $this->belongsTo('App\Customers','customers_id');
    }
    public function supplier(){
        return $this->belongsTo('App\Suppliers','suppliers_id');
    }
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function products()
    {
        return $this->belongsToMany('App\Products', 'purchase_orders_products')
        ->withPivot('quantity', 'purchase_price', 'subtotal', 'tax', 'total', 'currency_extension')
        ->withTimestamps();
    }
}
