<?php

namespace App\Repositories\Roles;

use App\Domain\Roles\Contracts\MapRolesInterface;
use App\Models\Roles\MapRoles;

class MapRolesEloquent implements MapRolesInterface
{
    public function showByUser($id)
    {
        return MapRoles::select('role_id', 'role_name')->where('user_id', $id)->get()->toArray();
    }
    public function store($data)
    {
        return MapRoles::create($data);
    }

    public function deleteByUser($id)
    {
        return MapRoles::where('user_id', $id)->delete();
    }

    public function delete($id)
    {
        return MapRoles::destroy($id);
    }
}