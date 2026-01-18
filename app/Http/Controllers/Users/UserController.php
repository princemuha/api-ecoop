<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Users\Services\UserService;

class UserController extends Controller
{
    public function __construct(
        protected UserService $user
    ) {
    }
    public function index()
    {
        return response()->json($this->user->index());
    }
    public function show($id)
    {
        return response()->json($this->user->show($id));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|unique:system_user,username',
            'fullname' => 'required|string',
            'email' => 'required|email|unique:system_user,email',
            'password' => 'required|min:4'
        ]);
        return response()->json($this->user->store($data));
    }
    public function update($id, Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|unique:system_user,username',
            'fullname' => 'required|string',
            'email' => 'required|email|unique:system_user,email',
            'password' => 'required|min:4'
        ]);
        return response()->json($this->user->update($id, $data));
    }
    public function delete($id)
    {
        return response()->json($this->user->delete($id));
    }
}