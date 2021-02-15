<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_stock', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id');
            $table->bigInteger('company_id')->default(1)->nullable();
            $table->string('batch_code', 70)->nullable();
            $table->integer('qty')->default(0);
            $table->enum('packaging_type', ['quarter', 'gallon', 'drum', 'small tin'])->nullable();
            $table->double('purchase_price')->default(0);
            $table->double('sale_price')->default(0);
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
        Schema::dropIfExists('products_stock');
    }
}
