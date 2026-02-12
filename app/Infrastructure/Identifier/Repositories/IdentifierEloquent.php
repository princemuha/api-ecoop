<?php

namespace App\Infrastructure\Identifier\Repositories;

use App\Infrastructure\Identifier\Contracts\IdentifierInterface;
use Illuminate\Support\Facades\DB;

class IdentifierEloquent implements IdentifierInterface
{
    /**
     * Create a new class instance.
     */

    public function generateID(string $tbl, string $id, int $sequence = 3): string
    {
        $lastRecord = DB::table($tbl)->whereRaw('LEFT(' . $id . ', 8) = ?', [date('Ymd')])->orderBy($id, 'desc')->first();
        $getCurrentID = $lastRecord ? $lastRecord->$id : (date('Ymd') . sprintf('%0' . $sequence . 'd', 1));
        return (string)((int)$getCurrentID + 1);
    }

}
