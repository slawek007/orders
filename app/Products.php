<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public function productType(){
        return $this->belongsTo('App\ProductTypes','product_types_id');
    }

    public function productsSupplierWithPrice()
    {
        return $this->belongsToMany('App\Suppliers', 'purchase_prices')
        ->withPivot('price', 'currency_name', 'currency_code', 'currency_extension','vatTax')
        ->withTimestamps();
    }

    public function productOrder()
    {
        return $this->belongsToMany('App\PurchaseOrders', 'purchase_orders_products')
        ->withPivot('quantity', 'purchase_price', 'subtotal', 'tax', 'total', 'currency_extension')
        ->withTimestamps();
    }

    public function productsMaterial()
    {
        return $this->belongsTo('App\ProductsMaterial', 'material_id');
    }

}
