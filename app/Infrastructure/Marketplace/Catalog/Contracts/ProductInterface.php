<?php

namespace App\Infrastructure\Marketplace\Catalog\Contracts;

interface ProductInterface
{
    public function getProduct();
    public function getProductDiscount();
}
