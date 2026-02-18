<?php

namespace App\Infrastructure\Marketplace\Banner\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'system_banner';
    protected $primaryKey = 'banner_id';
    protected $fillable = [
        'banner_id',
        'banner_title',
        'banner_desc',
        'banner_url',
        'banner_image',
        'banner_status',
        'banner_flow',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

    
    protected $hidden = [
        'banner_id',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}