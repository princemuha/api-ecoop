<?php

namespace App\Domain\Identifier\Contracts;

interface IdInterface
{
    public function getID5($table, $column);
}