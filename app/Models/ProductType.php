<?php

namespace App\Models;

class ProductType extends MainModel
{
    protected $table = 'products_type';

    protected $casts = [
        'sale_price' => 'object',
        'purchase_price' => 'object',
    ];

    public function range(){
        return $this->belongsTo('App\Models\ProductRange', 'range_id');
    }

    public function items(){
        return $this->hasMany('App\Models\Product', 'type_id');
    }
}
