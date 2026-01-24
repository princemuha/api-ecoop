<?php

namespace App\Domain\Product\Services;

use App\Domain\Product\Contracts\ProductInterface;
use App\Domain\Logging\Contracts\LoggingInterface;

class ProductService
{
    public function __construct(
        protected ProductInterface $product,
        protected LoggingInterface $logging
    ) {
    }

    public function index(): array
    {
        return $this->product->index();
    }

    public function show($id)
    {
        return $this->product->show($id);
    }

    public function store(array $data)
    {
        try {
            $this->product->store($data);
            return ['message' => 'success'];
        } catch (\Throwable $th) {
            $this->logging->errorLog([
                'message' => $th->getMessage(),
                'trace' => $th->getTraceAsString()
            ]);
            return $th->getMessage();
        }
    }

    public function update($id, array $data)
    {
        try {
            $this->product->update($id, $data);
            return ['message' => 'success'];
        } catch (\Throwable $th) {
            $this->logging->errorLog([
                'message' => $th->getMessage(),
                'trace' => $th->getTraceAsString()
            ]);
            return $th->getMessage();
        }
    }

    public function delete($id)
    {
        try {
            $this->product->delete($id);
            return ['message' => 'success'];
        } catch (\Throwable $th) {
            $this->logging->errorLog([
                'message' => $th->getMessage(),
                'trace' => $th->getTraceAsString()
            ]);
            return $th->getMessage();
        }
    }

    public function recommended(): array
    {
        return $this->product->recommended();
    }
}