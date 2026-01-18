<?php

namespace App\Domain\Identifier\Services;

use App\Domain\Identifier\Contracts\IdInterface;

class IdService
{
    public function __construct(protected IdInterface $id)
    {
    }

    public function getID5($table, $column)
    {
        return $this->id->getID5($table, $column) + 1;
    }
}