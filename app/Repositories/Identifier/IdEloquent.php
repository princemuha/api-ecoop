<?php

namespace App\Repositories\Identifier;

use App\Domain\Identifier\Contracts\IdInterface;
use Illuminate\Support\Facades\DB;

class IdEloquent implements IdInterface
{
    public function getID5($table, $column)
    {
        return DB::table($table)->whereRaw('LEFT(' . $column . ', 8) = ?', [date('Ymd')])->first() ?? date('Ymd') . '00000';
    }
}