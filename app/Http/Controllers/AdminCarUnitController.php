<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class AdminCarUnitController extends Controller
{
    private function requireAdmin()
    {
        if (!session()->has('admin')) {
            return redirect('/admin');
        }
        return null;
    }

    public function index($carId)
    {
        if ($redirect = $this->requireAdmin()) return $redirect;

        if (!Schema::hasTable('car_units')) {
            $car = Car::findOrFail($carId);
            return view('admin.car_units', [
                'car' => $car,
                'units' => collect(),
                'schemaReady' => false,
            ]);
        }

        $car = Car::findOrFail($carId);
        $units = CarUnit::query()->where('car_id', $car->id)->orderByDesc('id')->get();

        return view('admin.car_units', [
            'car' => $car,
            'units' => $units,
            'schemaReady' => true,
        ]);
    }

    public function store(Request $request, $carId)
    {
        if ($redirect = $this->requireAdmin()) return $redirect;

        if (!Schema::hasTable('car_units')) {
            return back()->with('error', 'Car units table not found. Run migrations first.');
        }

        $car = Car::findOrFail($carId);

        $data = $request->validate([
            'number_plate' => 'nullable|string|max:50',
            'status' => 'required|in:active,maintenance,inactive',
        ]);

        CarUnit::create([
            'car_id' => $car->id,
            'number_plate' => $data['number_plate'] ?: null,
            'status' => $data['status'],
        ]);

        return redirect("/admin/cars/{$car->id}/units")->with('success', 'Unit added');
    }

    public function bulk(Request $request, $carId)
    {
        if ($redirect = $this->requireAdmin()) return $redirect;

        if (!Schema::hasTable('car_units')) {
            return back()->with('error', 'Car units table not found. Run migrations first.');
        }

        $car = Car::findOrFail($carId);
        $data = $request->validate([
            'count' => 'required|integer|min:1|max:200',
        ]);

        for ($i = 0; $i < (int) $data['count']; $i++) {
            CarUnit::create([
                'car_id' => $car->id,
                'number_plate' => null,
                'status' => 'active',
            ]);
        }

        return redirect("/admin/cars/{$car->id}/units")->with('success', 'Units added');
    }

    public function delete($carId, $unitId)
    {
        if ($redirect = $this->requireAdmin()) return $redirect;

        if (!Schema::hasTable('car_units')) {
            return back()->with('error', 'Car units table not found. Run migrations first.');
        }

        $unit = CarUnit::query()->where('car_id', $carId)->where('id', $unitId)->firstOrFail();
        $unit->delete();

        return back()->with('success', 'Unit deleted');
    }
}
