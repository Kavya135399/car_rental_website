<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
    'booking_code',
    'car_id',
    'car_unit_id',
    'driver_id',
    'car',
    'price_per_day',
    'passengers',
    'name',
    'phone',
    'email',
    'pickup',
    'drop',
    'date',
    'pickup_time',
    'return_date',
    'total_days',
    'total_amount',
    'payment_method',
    'payment_proof',
    'message',
    'pickup_at',
    'dropoff_at',
    'pickup_location',
    'dropoff_location',
    'status',
];

    protected $casts = [
        'pickup_at' => 'datetime',
        'dropoff_at' => 'datetime',
    ];

    public function carModel()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }

    public function unit()
    {
        return $this->belongsTo(CarUnit::class, 'car_unit_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
