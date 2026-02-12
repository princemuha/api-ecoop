<?php

namespace App\Infrastructure\Identifier\Contracts;

Interface IdentifierInterface
{
    public function generateID(string $tbl, string $id, int $sequence = 3);
}
