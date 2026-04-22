<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Services\CarAvailability;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ApiCarAvailabilityController extends Controller
{
    public function show(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        if (!Schema::hasTable('car_units') || !Schema::hasTable('bookings')) {
            return response()->json([
                'car_id' => $car->id,
                'total_units' => 0,
                'available_units' => 0,
            ]);
        }

        $pickupAtRaw = $request->query('pickup_at');
        $dropoffAtRaw = $request->query('dropoff_at');

        if (!$pickupAtRaw || !$dropoffAtRaw) {
            return response()->json([
                'error' => 'pickup_at and dropoff_at are required',
            ], 422);
        }

        $pickupAt = Carbon::parse($pickupAtRaw);
        $dropoffAt = Carbon::parse($dropoffAtRaw);

        if ($dropoffAt->lessThanOrEqualTo($pickupAt)) {
            return response()->json([
                'error' => 'dropoff_at must be after pickup_at',
            ], 422);
        }

        $availability = new CarAvailability();

        return response()->json([
            'car_id' => $car->id,
            'total_units' => $availability->totalUnits($car),
            'available_units' => $availability->availableUnits($car, $pickupAt, $dropoffAt),
        ]);
    }
}

