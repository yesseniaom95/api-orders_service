<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderItem extends Model
{
    protected $table = 'orders_service.order_items';

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_price',
        'kitchen_notes',
        'status',
    ];

    public function itemAdditions(): HasMany
    {
        return $this->hasMany(OrderItemAddition::class, 'order_item_id');
    }
}