<?php

namespace App\Repositories\Logging;

use App\Models\Logging\ErrorLog;
use App\Models\Logging\AccessLog;
use App\Domain\Logging\Contracts\LoggingInterface;

class LoggingEloquent implements LoggingInterface
{
    public function errorLog(array $data)
    {
        return ErrorLog::create($data);
    }

    public function accessLog(array $data)
    {
        return AccessLog::create($data);
    }
}
