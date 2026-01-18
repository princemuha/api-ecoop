<?php

namespace App\Domain\Roles\Services;

use App\Domain\Roles\Contracts\MapRolesInterface;

class MapRolesService
{
    public function __construct(
        protected MapRolesInterface $mapRoles
    ) {
    }

    public function showByUser($id)
    {
        return $this->mapRoles->showByUser($id);
    }
    public function store($data)
    {
        return $this->mapRoles->store($data);
    }

    public function deleteByUser($id)
    {
        return $this->mapRoles->deleteByUser($id);
    }

    public function delete($id)
    {
        return $this->mapRoles->delete($id);
    }
}