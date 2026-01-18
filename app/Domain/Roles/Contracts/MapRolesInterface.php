<?php

namespace App\Domain\Roles\Contracts;

interface MapRolesInterface
{
    public function showByUser($id);
    public function store($data);
    public function deleteByUser($id);
    public function delete($id);
}