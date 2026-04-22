<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class AdminDriverController extends Controller
{
    private function requireAdmin()
    {
        if (!session()->has('admin')) {
            return redirect('/admin');
        }
        return null;
    }

    public function index()
    {
        if ($redirect = $this->requireAdmin()) return $redirect;

        if (!Schema::hasTable('drivers')) {
            return view('admin.drivers', [
                'drivers' => collect(),
                'schemaReady' => false,
            ]);
        }

        $drivers = Driver::query()->orderByDesc('id')->get();
        return view('admin.drivers', [
            'drivers' => $drivers,
            'schemaReady' => true,
        ]);
    }

    public function store(Request $request)
    {
        if ($redirect = $this->requireAdmin()) return $redirect;

        if (!Schema::hasTable('drivers')) {
            return back()->with('error', 'Drivers table not found. Run migrations first.');
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:30',
            'license_number' => 'required|string|max:80',
            'is_active' => 'nullable|boolean',
        ]);

        Driver::create([
            'name' => $data['name'],
            'mobile' => $data['mobile'],
            'license_number' => $data['license_number'],
            'is_active' => (bool) ($data['is_active'] ?? true),
        ]);

        return back()->with('success', 'Driver added');
    }

    public function toggle($id)
    {
        if ($redirect = $this->requireAdmin()) return $redirect;

        if (!Schema::hasTable('drivers')) {
            return back()->with('error', 'Drivers table not found. Run migrations first.');
        }

        $driver = Driver::findOrFail($id);
        $driver->is_active = !$driver->is_active;
        $driver->save();

        return back()->with('success', 'Driver updated');
    }

    public function delete($id)
    {
        if ($redirect = $this->requireAdmin()) return $redirect;

        if (!Schema::hasTable('drivers')) {
            return back()->with('error', 'Drivers table not found. Run migrations first.');
        }

        $driver = Driver::findOrFail($id);
        $driver->delete();

        return back()->with('success', 'Driver deleted');
    }
}
