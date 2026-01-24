<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Models\Order\OrderDetail;

class Product extends Model
{
    use HasFactory, Notifiable;
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
        'created_by',
        'updated_by',
    ];

    public function hasStock(): bool
    {
        return $this->stock > 0;
    }

    public function isActive(): bool
    {
        return $this->status_active == 'active';
    }
}