<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    protected $appends = ['slug'];

    protected $casts = [
        'features' => 'array',
        'pack_sizes' => 'array',
        'colors' => 'array',
        'gallery' => 'array',
        'is_best_seller' => 'boolean',
        'is_in_stock' => 'boolean',
    ];

    public function getSlugAttribute()
    {
        if (!empty($this->attributes['slug'])) {
            return $this->attributes['slug'];
        }
        return Str::slug($this->name);
    }
}
