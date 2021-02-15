<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->double('purchase_price')->nullable()->after('is_active');
            $table->double('sale_price')->nullable()->after('purchase_price');
        });

        Schema::table('products_stock', function (Blueprint $table) {
            $table->removeColumn('sale_price');
            $table->removeColumn('purchase_price');
        });

        Schema::table('products_type', function (Blueprint $table) {
            $table->removeColumn('sale_price');
            $table->removeColumn('margin');
            $table->removeColumn('purchase_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->removeColumn('sale_price');
            $table->removeColumn('purchase_price');
        });

        Schema::table('products_stock', function (Blueprint $table) {
            $table->double('purchase_price')->nullable();
            $table->double('sale_price')->nullable();
        });

        Schema::table('products_type', function (Blueprint $table) {
            $table->double('purchase_price')->nullable();
            $table->integer('margin')->nullable();
            $table->double('sale_price')->nullable();
        });
    }
}
