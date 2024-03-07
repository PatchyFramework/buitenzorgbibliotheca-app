<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable;

    public $guard_name = 'web';

    protected $table = "user";
    protected $foreignKey = "userid";
    protected $primaryKey = "userid";

    protected $fillable = [
        'username',
        'password',
        'email',
        'email_verified_at',
        'namalengkap',
        'alamat',
        'imguser',
    ];

    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    
    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class, 'model_has_roles', 'role_id', 'model_id', 'model_type');
    // }


    // public function hasRole($role)
    // {
    //     return $this->roles->contains('name', $role);
    // }
}
