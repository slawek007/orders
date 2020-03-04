<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')
                ->on('products')->onDelete('cascade');
            $table->unsignedInteger('supplayer_id');
            $table->foreign('supplayer_id')->references('id')
                ->on('suppliers')->onDelete('set null');
            $table->float('currency_sum', 10, 2);
            $table->string('currency_name')->nullable();
            $table->string('currency_code')->nullable();;
            $table->string('currency_extension');
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
        Schema::dropIfExists('purchase_prices');
    }
}
