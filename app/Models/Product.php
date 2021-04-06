<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends MainModel
{
    use SoftDeletes;
    protected $table = 'products';

    public function product_type(){
        return $this->belongsTo('App\Models\ProductType', 'type_id');
    }

    public function range(){
        return $this->belongsTo('App\Models\ProductRange', 'range_id');
    }

    public function related(){
        return $this->hasMany('App\Models\Product', 'item_no', 'item_no');
    }
}
