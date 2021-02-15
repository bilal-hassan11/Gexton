<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPricesColumnInProductsTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products_type', function (Blueprint $table) {
            $table->text('purchase_price')->nullable()->after('slug');
            $table->text('sale_price')->nullable()->after('purchase_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products_type', function (Blueprint $table) {
            $table->dropColumn('purchase_price');
            $table->dropColumn('sale_price');
        });
    }
}
