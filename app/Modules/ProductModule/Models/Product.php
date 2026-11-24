<?php

namespace App\Modules\ProductModule\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'sku',
        'name',
        'description',
        'unit',
        'minimum_stock',
    ];

    protected function casts(): array
    {
        return [
            'minimum_stock' => 'integer',
        ];
    }
}
