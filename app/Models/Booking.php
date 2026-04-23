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
    'amount_paid',
    'payment_method',
    'payment_gateway',
    'payment_proof',
    'payment_utr',
    'payment_status',
    'online_payment_terms_accepted_at',
    'receipt_number',
    'receipt_generated_at',
    'gateway_order_id',
    'gateway_payment_id',
    'gateway_signature',
    'refund_id',
    'refund_amount',
    'refund_status',
    'refunded_at',
    'payment_verified_at',
    'payment_verified_by',
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
        'payment_verified_at' => 'datetime',
        'online_payment_terms_accepted_at' => 'datetime',
        'receipt_generated_at' => 'datetime',
        'refunded_at' => 'datetime',
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
