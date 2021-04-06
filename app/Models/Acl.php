<?php

namespace App\Models;

use App\Traits\DianujHashidsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Acl extends Model
{
    use DianujHashidsTrait;

    protected $table =  'acls';

    // protected $fillable = ['user_id','ips'];

    public function users(){
        return $this->belongsTo('App\Models\User','user_id');
    }
}
