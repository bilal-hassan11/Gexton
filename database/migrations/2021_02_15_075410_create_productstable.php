<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductstable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('range_id');
            $table->bigInteger('type_id');
            $table->string('item_code');
            $table->string('item_name')->nullable();
            $table->string('item_no')->nullable();
            $table->double('packaging')->nullable();
            $table->enum('packaging_type', ['quarter', 'gallon', 'drum', 'small tin'])->nullable();
            $table->boolean('is_active')->default(1)->nullable();
            $table->timestamps();
            $table->softDeletes();
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
