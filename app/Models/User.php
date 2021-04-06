<?php

namespace App\Models;
use App\Traits\DianujHashidsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use DianujHashidsTrait,HasFactory;

    protected $table = 'users';
}
