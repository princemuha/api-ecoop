<?php

namespace App\Domain\Product\Contracts;

interface ProductInterface
{
    public function index();
    public function show($id);
    public function store($data);
    public function update($id, $data);
    public function delete($id);
    public function recommended();
}