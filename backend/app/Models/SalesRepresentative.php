<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesRepresentative extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'designation',
        'phone',
        'whatsapp',
        'email',
        'districts',
        'image',
        'is_active',
        'sort_order',
        'notes',
    ];

    protected $casts = [
        'districts' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
}

