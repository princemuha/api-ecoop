<?php

namespace App\Infrastructure\Auth\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AuthUser extends Authenticatable
{
    use HasFactory, HasApiTokens;
    protected $primaryKey = 'user_id';
    protected $table = 'system_user';
    protected $keyType = 'number';
    public $incrementing = false;
    protected $fillable = [
        'user_id',
        'profile_id',
        'username',
        'fullname',
        'password',
        'email',
        'email_verified_at',
        'remember_token',
        'status_active',
        'otp',
        'otp_expires_at',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'user_id' => 'string',
        'profile_id' => 'string',
        'username' => 'string',
        'fullname' => 'string',
        'password' => 'hashed',
        'email' => 'string',
        'email_verified_at' => 'datetime',
        'remember_token' => 'string',
        'status_active' => 'string',
        'otp' => 'string',
        'otp_expires_at' => 'datetime',
        'created_by' => 'string',
        'updated_by' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'created_by',
        'updated_by',
        'otp',
        'otp_expires_at',
        'created_at',
        'updated_at'
    ];

    public function isActive()
    {
        return $this->status_active === 'active';
    }

    public function isVerified()
    {
        return $this->email_verified_at !== null;
    }
}
