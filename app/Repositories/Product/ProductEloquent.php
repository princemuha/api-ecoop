<?php

namespace App\Repositories\Product;

use App\Domain\Product\Contracts\ProductInterface;
use App\Models\Product\Product;
use App\Models\Order\Order;

class ProductEloquent implements ProductInterface
{
    public function index()
    {
        return Product::all();
    }

    public function show($id)
    {
        return Product::find($id);
    }

    public function store($data)
    {
        return Product::create($data);
    }

    public function update($id, $data)
    {
        $product = Product::find($id);
        $product->update($data);
        return $product;
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return $product;
    }

    public function recommended()
    {
        $user = auth()->user();
        $mostBoughtByMe = Product::select('master_product.product_id', 'master_product.product_name', 'master_product.default_image')
            ->leftJoin('transaction_order_detail', 'master_product.product_id', '=', 'transaction_order_detail.product_id')
            ->leftJoin('transaction_order', 'transaction_order_detail.order_id', 'transaction_order.order_id')
            ->selectRaw('SUM(transaction_order_detail.qty) as total_sold')
            ->where('transaction_order.customer_id', $user->user_id)
            ->groupBy('master_product.product_id', 'master_product.product_name', 'master_product.default_image')
            ->orderByDesc('total_sold')
            ->limit(4)
            ->get()->toArray();
        $mostBoughtByOther = Product::select('master_product.product_id', 'master_product.product_name', 'master_product.default_image')
            ->leftJoin('transaction_order_detail', 'master_product.product_id', '=', 'transaction_order_detail.product_id')
            ->leftJoin('transaction_order', 'transaction_order_detail.order_id', 'transaction_order.order_id')
            ->selectRaw('SUM(transaction_order_detail.qty) as total_sold')
            ->where('transaction_order.customer_id', '!=', $user->user_id)
            ->groupBy('master_product.product_id', 'master_product.product_name', 'master_product.default_image')
            ->orderByDesc('total_sold')
            ->limit(4)
            ->get()->toArray();
        $return = array_merge($mostBoughtByMe, $mostBoughtByOther);
        return $return;
    }
}