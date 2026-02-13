<?php

namespace App\Infrastructure\Marketplace\Catalog\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'master_product';
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'product_id',
        'product_name',
        'sku',
        'barcode',
        'category_id',
        'store_id',
        'uom',
        'basic_price',
        'agent_price',
        'selling_price',
        'status_active',
        'stock',
        'note',
        'default_image',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

    public function isActive()
    {
        return $this->status_active == 'active';
    }
    
    public function isStockAvailable()
    {
        return $this->stock > 0;
    }
}
