<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'name',
        'rating',
        'message'
    ];
}

// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

// class Review extends Model
// {
//     protected $fillable = ['name', 'rating', 'message'];
// }
