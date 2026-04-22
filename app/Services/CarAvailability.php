<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Car;
use Carbon\CarbonInterface;
use Illuminate\Support\Facades\Schema;

class CarAvailability
{
    public const BLOCKING_STATUSES = ['Pending', 'Confirmed', 'In Use'];

    public function totalUnits(Car $car): int
    {
        if (!Schema::hasTable('car_units')) {
            // Stock table not migrated yet.
            return 0;
        }
        return (int) $car->units()->where('status', 'active')->count();
    }

    public function bookedUnits(Car $car, CarbonInterface $from, CarbonInterface $to): int
    {
        if (!Schema::hasTable('bookings') || !Schema::hasColumn('bookings', 'car_unit_id') || !Schema::hasColumn('bookings', 'pickup_at') || !Schema::hasColumn('bookings', 'dropoff_at') || !Schema::hasColumn('bookings', 'status')) {
            // Booking range columns not migrated yet.
            return 0;
        }
        return (int) Booking::query()
            ->where('car_id', $car->id)
            ->whereNotNull('car_unit_id')
            ->whereIn('status', self::BLOCKING_STATUSES)
            ->where(function ($q) use ($from, $to) {
                // Overlap: existing.start < new.end AND existing.end > new.start
                $q->where('pickup_at', '<', $to)
                    ->where('dropoff_at', '>', $from);
            })
            ->distinct()
            ->count('car_unit_id');
    }

    public function availableUnits(Car $car, CarbonInterface $from, CarbonInterface $to): int
    {
        $total = $this->totalUnits($car);
        $booked = $this->bookedUnits($car, $from, $to);
        return max(0, $total - $booked);
    }
}
