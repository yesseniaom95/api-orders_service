<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Additions extends Model
{
    use HasFactory;
    protected $keyType  = 'int';
    protected $table    = 'orders_service.additions';
    public $incrementing = true;

    protected $fillable = [
        'product_id',
        'name',
        'additional_price',
    ];
}
