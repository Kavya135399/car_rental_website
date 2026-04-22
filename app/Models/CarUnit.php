<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'number_plate',
        'status',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}

