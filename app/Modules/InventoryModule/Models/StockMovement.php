<?php

namespace App\Modules\InventoryModule\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Modules\InventoryModule\Database\Factories\StockMovementFactory;

class StockMovement extends Model
{
    use HasFactory;

    public const TYPE_IN = 'in';
    public const TYPE_OUT = 'out';

    protected $table = 'stock_movements';

    protected $fillable = [
        'product_id',
        'supplier_id',
        'type',
        'quantity',
        'movement_date',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'product_id' => 'integer',
            'supplier_id' => 'integer',
            'quantity' => 'integer',
            'movement_date' => 'date',
        ];
    }

    protected static function newFactory(): StockMovementFactory
    {
        return StockMovementFactory::new();
    }
}
