<?php

namespace App\Domain\Users\Contracts;

interface UserInterface
{
    public function index();
    public function show($id);
    public function store($data);
    public function update($id, $data);
    public function delete($id);
}