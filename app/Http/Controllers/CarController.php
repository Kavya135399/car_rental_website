<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car; // Make sure this model exists
use App\Services\CarAvailability;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class CarController extends Controller
{
    public function cars()
    {
        $q = request('q');
        $brand = request('brand');
        $minPrice = request('min_price');
        $maxPrice = request('max_price');

        $from = request('from');
        $to = request('to');

        $fromAt = $from ? Carbon::parse($from) : now();
        $toAt = $to ? Carbon::parse($to) : now()->addDay();

        $carsQuery = Car::query();

        if ($q) {
            $carsQuery->where(function ($query) use ($q) {
                $query->where('name', 'like', '%' . $q . '%')
                    ->orWhere('brand', 'like', '%' . $q . '%');
            });
        }

        if ($brand) {
            $carsQuery->where('brand', $brand);
        }

        if (Schema::hasColumn('cars', 'price_per_day') && $minPrice !== null && $minPrice !== '') {
            $carsQuery->where('price_per_day', '>=', (float) $minPrice);
        }

        if (Schema::hasColumn('cars', 'price_per_day') && $maxPrice !== null && $maxPrice !== '') {
            $carsQuery->where('price_per_day', '<=', (float) $maxPrice);
        }

        if (Schema::hasColumn('cars', 'featured')) {
            $carsQuery->orderByDesc('featured');
        }
        $cars = $carsQuery->orderBy('name')->get();

        $availability = new CarAvailability();
        $carAvailability = [];
        foreach ($cars as $car) {
            $total = $availability->totalUnits($car);
            $available = $availability->availableUnits($car, $fromAt, $toAt);
            $carAvailability[$car->id] = [
                'total' => $total,
                'available' => $available,
            ];
        }

        $brands = Car::query()->select('brand')->whereNotNull('brand')->distinct()->orderBy('brand')->pluck('brand');

        return view('cars', compact('cars', 'carAvailability', 'brands', 'fromAt', 'toAt'));
    }
    public function show($id)
{
    $car = Car::findOrFail($id); // fetch car
    return view('car-single-db', compact('car'));
}
}
