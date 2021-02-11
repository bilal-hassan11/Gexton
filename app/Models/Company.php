<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends MainModel
{
    use SoftDeletes;
    protected $table = 'companies';

    public function users()
    {
        return $this->hasMany('App\Models\Admin', 'company_id');
    }
}
