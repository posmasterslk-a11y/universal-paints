<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebLayout extends Model
{
    use HasFactory;

    protected $table = 'web_layouts';

    protected $fillable = [
        'page',
        'key',
        'value',
    ];

    protected $casts = [
        'value' => 'array',
    ];
}
