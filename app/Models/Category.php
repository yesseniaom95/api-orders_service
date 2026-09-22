<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $keyType  = 'string';
    protected $table    = 'orders_service.categories';

    protected $fillable = [
        'name',
        'icon',
        'sort_order'
    ];
}
