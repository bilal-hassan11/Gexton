<?php

namespace App\Models;

use App\Traits\DianujHashidsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DBS extends Model
{
    use HasFactory;
    use DianujHashidsTrait;
    protected $table =  'dbs';
}
