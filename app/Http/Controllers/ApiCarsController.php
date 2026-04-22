<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Services\CarAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ApiCarsController extends Controller
{
    public function index(Request $request)
    {
        $cars = Car::query()->orderBy('id', 'desc')->get();

        $availability = new CarAvailability();

        $fromAt = now();
        $toAt = now()->addDay();

        $items = [];
        foreach ($cars as $car) {
            $imageUrl = null;
            if (!empty($car->image)) {
                // Prefer /storage for uploaded images (public disk).
                if (str_starts_with($car->image, 'cars_uploads/') || str_starts_with($car->image, 'cars/') || str_starts_with($car->image, 'public/')) {
                    $imageUrl = asset('storage/' . $car->image);
                } else {
                    $imageUrl = asset('images/' . $car->image);
                }
            }

            $totalUnits = 0;
            $availableUnits = 0;

            if (Schema::hasTable('car_units')) {
                $totalUnits = $availability->totalUnits($car);
                $availableUnits = $availability->availableUnits($car, $fromAt, $toAt);
            }

            $items[] = [
                'id' => $car->id,
                'name' => $car->name,
                'brand' => $car->brand,
                'price_per_day' => $car->price_per_day,
                'seats' => $car->seats,
                'fuel_type' => $car->fuel_type,
                'transmission' => $car->transmission,
                'image_url' => $imageUrl,
                'total_units' => $totalUnits,
                'available_units' => $availableUnits,
            ];
        }

        return response()->json([
            'cars' => $items,
        ]);
    }
}
