<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = "permissions";

    protected $fillable = [
        'name',
        'display_name',
    ];

    public function roles()
    {

        return $this->belongsToMany('App\Models\Role', 'roles_permissions');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'users_permissions', 'user_id', 'permission_id');
    }
}
