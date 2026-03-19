<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
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
    'message'
];
}