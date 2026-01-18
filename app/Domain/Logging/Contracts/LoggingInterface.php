<?php

namespace App\Domain\Logging\Contracts;

interface LoggingInterface
{
    public function errorLog(array $data);
    public function accessLog(array $data);
}
