<?php

namespace App\Models\Logging;

use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    protected $table = 'system_log_access';
    protected $primaryKey = 'access_id';
    public $incrementing = false;

    protected $fillable = [
        'access_id',
        'msg',
        'timestamp',
        'url',
        'method',
        'ip',
    ];

    public $timestamps = false;
}
