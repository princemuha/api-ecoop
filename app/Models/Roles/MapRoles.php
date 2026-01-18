<?php

namespace App\Models\Roles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class MapRoles extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'map_user_role';
    protected $primaryKey = 'map_user_role_id';
    protected $fillable = [
        'map_user_role_id',
        'user_id',
        'role_id',
        'role_name',
        'created_by',
        'updated_by'
    ];

    protected $hidden = [
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
}