<?php

namespace App\Modules\SupplierModule\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Modules\SupplierModule\Database\Factories\SupplierFactory;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';

    protected $fillable = [
        'code',
        'name',
        'phone',
        'email',
        'address',
    ];

    protected static function newFactory(): SupplierFactory
    {
        return SupplierFactory::new();
    }
}