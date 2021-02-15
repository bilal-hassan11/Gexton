<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends MainModel
{
    use SoftDeletes;
    protected $table = 'products';
}
