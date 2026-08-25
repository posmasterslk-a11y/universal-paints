<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    protected $casts = [
        'features' => 'array',
        'pack_sizes' => 'array',
        'colors' => 'array',
        'gallery' => 'array',
        'is_best_seller' => 'boolean',
        'is_in_stock' => 'boolean',
    ];
}
