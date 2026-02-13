<?php

namespace App\Interface\Controllers\Marketplace\Catalog;

use App\Application\Marketplace\Catalog\UseCase\GetProduct;
use App\Application\Marketplace\Catalog\UseCase\GetProductDiscount;
use App\Shared\Handlers\JsonHandler;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    public function __construct(
        private GetProduct $product,
        private GetProductDiscount $productDiscount,
        private JsonHandler $jsonHandler,
    )
    {}
    public function index()
    {
        return $this->jsonHandler->handle('success', (object) $this->getProduct->execute());
    }
    public function product_discount()
    {
        return $this->jsonHandler->handle('success', (object) $this->productDiscount->execute());
    }
}