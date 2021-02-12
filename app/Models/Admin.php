<?php

namespace App\Models;

use App\Permissions\HasPermissionsTrait;
use App\Traits\DianujHashidsTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable, DianujHashidsTrait, SoftDeletes, HasPermissionsTrait;

    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'first_name', 'last_name', 'image', 'user_role'
    ];

    protected $casts = [
        'user_permissions' => 'object'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFullNameAttribute()
    {
        return ucwords($this->first_name . ' ' . $this->last_name);
    }

    public function getCompleteNameAttribute()
    {
        return !empty($this->company_name) ? $this->full_name.' ('.$this->company_name.')' : $this->full_name;
    }

    public function getIsAdminAttribute()
    {
        return $this->user_type == 'admin';
    }

    public function getIsNormalAttribute()
    {
        return $this->user_type == 'normal';
    }

    public function getUserRoleAttribute()
    {
        return ucwords(str_replace('-', ' ', $this->user_type));
    }

    public function sendPasswordResetNotification($token)
    {
        // $this->notify(new AdminResetPasswordNotification($token));
    }

    public function scopeNotifiables($query)
    {
        return $query->whereIsActive(1)->whereUserType('admin')->get();
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
}
