<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'subtitle',
        'body',
        'image',
        'meta',
        'sort_order',
        'is_published',
    ];

    protected $casts = [
        'meta' => 'array',
        'is_published' => 'boolean',
    ];
}

