<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    protected $keyType      = 'string';
    protected $table        = 'orders_service.tables';
    public $incrementing    = true;

    protected $fillable = [
        'table_number',
        'zone',
        'status'
    ];

}
