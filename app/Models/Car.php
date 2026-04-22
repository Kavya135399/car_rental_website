<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'image',
        'images',
        'price_per_day',
        'seats',
        'fuel_type',
        'transmission',
        'featured',
        'description',
    ];
    protected $casts = [
    'images' => 'array',
];

    public function units()
    {
        return $this->hasMany(CarUnit::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
