<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $keyType = 'int';
    protected $table = 'orders_service.products';
    

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'is_available',
        'is_combo',
        'tracks_stock',
        'current_stock',
    ];

    protected $casts = [
        'price'         => 'decimal:2',
        'is_available'  => 'boolean',
        'is_combo'      => 'boolean',
        'tracks_stock'  => 'boolean',
        'current_stock' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


    public function comboOptions()
    {
        return $this->hasMany(ComboOptions::class, 'combo_id');
    }
}
