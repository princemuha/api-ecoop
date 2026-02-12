<?php

namespace App\Infrastructure\Auth\Models;

use Illuminate\Database\Eloquent\Model;

class AuthMapRoles extends Model
{
    protected $primaryKey = "map_user_role_id";
    protected $table = "map_user_role";
    protected $keyType = "number";
    public $incrementing = false;
    protected $fillable = [
        "map_user_role_id",
        "user_id",
        "role_id",
        "role_name",
        "created_by",
        "updated_by",
        "created_at",
        "updated_at"
    ];
    protected $casts = [
        "map_user_role_id" => "string",
        "user_id" => "string",
        "role_id" => "string",
        "role_name" => "string",
        "created_by" => "string",
        "updated_by" => "string",
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
    protected $hidden = [
        "created_by",
        "updated_by",
        "created_at",
        "updated_at"
    ];
}
