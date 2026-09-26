<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItemAddition extends Model
{
    protected $table = 'orders_service.order_item_additions';

    // Desactivar updated_at porque la tabla solo cuenta con created_at
    public const UPDATED_AT = null;

    protected $fillable = [
        'order_item_id',
        'addition_id',
        'additional_price',
    ];
}