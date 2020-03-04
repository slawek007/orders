<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->char('order_code', 16);
            $table->string('billing_name')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                  ->onUpdate('cascade')->onDelete('set null');
            $table->integer('billing_suppliers_id')->unsigned();
            $table->foreign('billing_suppliers_id')->references('id')->on('suppliers')
                  ->onUpdate('cascade')->onDelete('set null');
            $table->integer('billing_customers_id')->unsigned();
            $table->foreign('billing_customers_id')->references('id')->on('customers')
                  ->onUpdate('cascade')->onDelete('set null');
            $table->date('shipping_date');
            $table->date('payment_date');
            $table->integer('billing_subtotal');
            $table->integer('billing_tax');
            $table->integer('billing_total');
            $table->string('error')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_orders');
    }
}
