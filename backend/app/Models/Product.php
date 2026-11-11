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

    /**
     * Retrieve the model for a bound value (supports both numeric ID and slug).
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        if (is_numeric($value)) {
            return $this->where($field ?? 'id', $value)->first();
        }

        if (\Illuminate\Support\Facades\Schema::hasColumn('products', 'slug')) {
            $p = $this->where('slug', $value)->first();
            if ($p) return $p;
        }

        $all = static::all();
        $p = $all->first(function ($item) use ($value) {
            return Str::slug($item->name) === $value;
        });
        if ($p) return $p;

        $nameGuess = str_replace(['-', '_'], ' ', $value);
        return $this->where('name', 'LIKE', "%{$nameGuess}%")->first();
    }
}
