<?php

namespace App\Domain\Logging\Services;

use App\Domain\Logging\Contracts\LoggingInterface;
use App\Domain\Identifier\Contracts\IdInterface;

class LoggingService
{
    public function __construct(
        protected LoggingInterface $logs,
        protected IdInterface $IdService
    ) {
    }

    public function errorLog(object $request, object $th)
    {
        $logData = array(
            'error_id' => $this->IdService->getID5('system_log_errors', 'error_id'),
            'msg' => $th->getMessage(),
            'timestamp' => date('Y-m-d H:i:s'),
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'ip' => $request->ip(),
        );
        return $this->logs->errorLog($logData);
    }

    public function accessLog(object $request)
    {
        $logData = array(
            'access_id' => $this->IdService->getID5('system_log_access', 'access_id'),
            'msg' => auth()->user()->id ?? 'Guest',
            'timestamp' => date('Y-m-d H:i:s'),
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'ip' => $request->ip(),
        );
        return $this->logs->accessLog($logData);
    }
}
