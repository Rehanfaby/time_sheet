<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $fillable = [
        'name', 'email', 'password',"phone","company_name", "role_id", "biller_id",
        "warehouse_id", "is_active", "is_deleted", "sign", "stemp", "otp", "otp_time",
        "otp_verify", "region_id", "project_id", "weak_start", "weak_end", "superviser_id"
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isActive()
    {
        return $this->is_active;
    }

    public function holiday() {
        return $this->hasMany('App\Holiday');
    }

    public function region() {
        return $this->belongsTo('App\Region');
    }

    public function superviser() {
        return $this->belongsTo('App\User', 'superviser_id', 'id');
    }

    public function projects() {
        return $this->hasMany('App\UserProject');
    }

    public function role() {
        return $this->belongsTo('App\Roles', 'role_id', 'id');
    }
}
