<?php

namespace App\Repositories\Users;

use App\Domain\Users\Contracts\UserInterface;
use App\Models\Users\User;

class UserEloquent implements UserInterface
{
    public function index()
    {
        return User::all();
    }

    public function show($id)
    {
        return User::find($id);
    }

    public function store($data)
    {
        return User::create($data);
    }

    public function update($id, $data)
    {
        return User::find($id)->update($data);
    }

    public function delete($id)
    {
        return User::destroy($id);
    }
}