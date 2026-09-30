<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComboOptions extends Model
{
    use HasFactory;
    protected $table = 'orders_service.combo_options';

    protected $fillable = [
        'combo_id',
        'step_name',
        'option_product_id'
    ];

    /**
     * Relación con el Producto principal (Combo)
     */
    public function combo()
    {
        return $this->belongsTo(Product::class, 'combo_id');
    }

    /**
     * Relación con el Producto opcional (Opción)
     */
    public function optionProduct()
    {
        return $this->belongsTo(Product::class, 'option_product_id');
    }

}
