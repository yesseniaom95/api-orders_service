<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    protected $table = 'orders_service.products';
    

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id'
    ];
}
