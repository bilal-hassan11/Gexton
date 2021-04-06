<?php

namespace App\Models;

use App\Traits\DianujHashidsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ippool extends Model
{
    use HasFactory;
    use DianujHashidsTrait;
    protected $table =  'ippools';

    public function dbs(){
       return $this->belongsTo('App\Models\DBS');
    }


}
