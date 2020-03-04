<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PurchaseOrdersProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        {
            Schema::create('purchase_orders_products', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('purchase_orders')->unsigned();
                $table->integer('products_id')->unsigned();
                 $table->integer('quantity')->unsigned();
                $table->float('purchase_price', 10, 2);
                $table->float('subtotal');
                $table->float('tax');
                $table->float('total');
                $table->string('currency_extension');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
