<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    //protected $fillable = ['short_name', 'code', 'company', 'street', 'zip_code', 'city', 'country', 'nip', 'phone', 'email', 'payment'];
    protected $guarded = [];

    public function productsWithPrice()
    {
        return $this->belongsToMany('App\Products', 'purchase_prices')
        ->withPivot('price', 'currency_name', 'currency_code', 'currency_extension')
        ->withTimestamps();
    }
    public function purchaseOrders(){
        return $this->hasMany('App\PurchaseOrders')->take(10);
    }
}
