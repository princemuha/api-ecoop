<?php

namespace App\Models\Logging;

use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    protected $table = 'system_log_errors';
    protected $primaryKey = 'error_id';
    public $incrementing = false;

    protected $fillable = [
        'error_id',
        'msg',
        'timestamp',
        'url',
        'method',
        'ip',
    ];

    public $timestamps = false;
}
