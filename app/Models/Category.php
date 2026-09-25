<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $keyType  = 'int';
    protected $table    = 'orders_service.categories';
    public $incrementing = true;

    protected $fillable = [
        'name',
        'icon',
        'sort_order'
    ];
}
