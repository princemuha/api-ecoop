<?php

namespace App\Domain\Users\Services;

use App\Domain\Users\Contracts\UserInterface;
use App\Domain\Roles\Contracts\MapRolesInterface;
use App\Domain\Logging\Contracts\LoggingInterface;

class UserService
{
    public function __construct(
        protected UserInterface $user,
        protected MapRolesInterface $mapRoles,
        protected LoggingInterface $logging
    ) {
    }

    public function index(): array
    {
        return $this->user->index();
    }

    public function show($id)
    {
        return $this->user->show($id);
    }

    public function store(array $data)
    {
        return $this->user->store($data);
    }

    public function update($id, array $data)
    {
        return $this->user->update($id, $data);
    }

    public function delete($id)
    {
        try {
            return $this->mapRoles->deleteByUser($id) ? $this->user->delete($id) : false;
        } catch (\Throwable $th) {
            $this->logging->errorLog([
                'message' => $th->getMessage(),
                'trace' => $th->getTraceAsString()
            ]);
            return $th->getMessage();
        }
    }
}