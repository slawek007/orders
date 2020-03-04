<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('short_description')->unique();
            $table->string('description');
            $table->string('comments')->nullable();
            $table->char('unit_of_measure', 10);
            $table->integer('unit_multiplier')->default(1);
            $table->string('material');
            $table->string('shape');
            $table->float('dimension-1')->nullable();
            $table->float('dimension-2')->nullable();
            $table->float('dimension-3')->nullable();
            $table->float('dimension-4')->nullable();
            $table->integer('product_type_id')->unsigned();
            $table->foreign('product_type_id')->references('id')->on('product_types')
                  ->onDelete('set null');
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
        Schema::dropIfExists('products');
    }
}
