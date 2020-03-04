<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTypes extends Model
{
    public function productByType(){
        return $this->hasMany('App\Products');
    }
}
