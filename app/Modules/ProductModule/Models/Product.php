<?php

namespace App\Modules\ProductModule\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Modules\ProductModule\Database\Factories\ProductFactory;

class Product extends Model
{
    use HasFactory;

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

    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }
}
