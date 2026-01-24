<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Product\Services\ProductService;
class ProductController extends Controller
{

    public function __construct(protected ProductService $product)
    {
    }

    public function index()
    {
        return $this->product->index();
    }

    public function show($id)
    {
        return $this->product->show($id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);
        return $this->product->store($data);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);
        return $this->product->update($id, $data);
    }

    public function delete($id)
    {
        return $this->product->delete($id);
    }

    public function recommended()
    {
        return $this->product->recommended();
    }
}