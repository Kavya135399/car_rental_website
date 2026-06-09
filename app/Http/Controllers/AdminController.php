<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Review;
use App\Models\Contact;
use App\Models\User;
use App\Models\Car;
use App\Models\CarUnit;
use App\Models\Booking;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    private function storeOptimizedCarImage($file): string
    {
        if (!function_exists('imagecreatefromstring')) {
            return $file->store('cars_uploads', 'public');
        }

        $contents = file_get_contents($file->getRealPath());
        $source = @imagecreatefromstring($contents);

        if (!$source) {
            return $file->store('cars_uploads', 'public');
        }

        $sourceWidth = imagesx($source);
        $sourceHeight = imagesy($source);
        $scale = min(900 / $sourceWidth, 600 / $sourceHeight, 1);
        $targetWidth = (int) max(1, round($sourceWidth * $scale));
        $targetHeight = (int) max(1, round($sourceHeight * $scale));
        $target = imagecreatetruecolor($targetWidth, $targetHeight);

        imagecopyresampled($target, $source, 0, 0, 0, 0, $targetWidth, $targetHeight, $sourceWidth, $sourceHeight);

        $path = 'cars_uploads/' . Str::uuid() . '.webp';
        ob_start();
        $encoded = function_exists('imagewebp') && imagewebp($target, null, 75);
        $optimized = ob_get_clean();

        imagedestroy($source);
        imagedestroy($target);

        if (!$encoded || $optimized === false || $optimized === '') {
            return $file->store('cars_uploads', 'public');
        }

        Storage::disk('public')->put($path, $optimized);
        return $path;
    }

    public function login() {
        return view('admin.login');
    }

    public function logout() {
        session()->forget('admin');
        return redirect('/admin');
    }

    public function loginCheck(Request $request)
    {
            
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'User not found');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Wrong password');
        }

        session(['admin' => $user->id]);
        return redirect('/admin/dashboard');
    }

public function dashboard() {
    if (!session()->has('admin')) {
        return redirect('/admin');
    }

    $totalCars = DB::table('cars')->count();
    $totalBookings = DB::table('bookings')->count();
    $totalCustomers = DB::table('bookings')->distinct('phone')->count('phone');
    $totalMessages = DB::table('contacts')->count();

    $reviews = Review::latest()->take(5)->get();

    $recentActivities = [];
    $latestContacts = DB::table('contacts')
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get(['name']);
    foreach ($latestContacts as $c) {
        $recentActivities[] = "{$c->name} sent a contact message";
    }

    // Customer chart
    $customers = DB::table('contacts')
        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(id) as total'))
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->get();

    $months = [];
    $totals = [];
    foreach ($customers as $c) {
        $months[] = date("M", mktime(0,0,0,$c->month,10));
        $totals[] = $c->total;
    }

    // Booking chart
    $bookings = DB::table('bookings')
        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(id) as total'))
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->get();

    $bookingMonths = [];
    $bookingTotals = [];
    foreach ($bookings as $b) {
        $bookingMonths[] = date("M", mktime(0,0,0,$b->month,10));
        $bookingTotals[] = $b->total;
    }

    return view('admin.dashboard', compact(
        'totalCars', 'totalBookings', 'totalCustomers', 'totalMessages',
        'reviews', 'recentActivities', 'months', 'totals',
        'bookingMonths', 'bookingTotals'   // <--- add these
    ));
}

    // Cars CRUD
    public function cars() {
        if (!session()->has('admin')) return redirect('/admin');

        $cars = Car::query()
            ->withCount(['units as units_total' => function ($q) {
                $q->where('status', 'active');
            }])
            ->orderBy('id', 'desc')
            ->get();
        return view('admin.cars', compact('cars'));
    }

    public function addCar() {
        return view('admin.add_car');
    }

    public function saveCar(Request $request) {
        if (!session()->has('admin')) return redirect('/admin');

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'price_per_day' => 'nullable|numeric|min:0',
            'seats' => 'nullable|integer|min:1|max:60',
            'fuel_type' => 'nullable|string|max:50',
            'transmission' => 'nullable|string|max:50',
            'featured' => 'nullable|boolean',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,avif|max:4096',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $this->storeOptimizedCarImage($request->file('image'));
        }

        $insert = [
            'name' => $data['name'],
            'brand' => $data['brand'],
            'image' => $imagePath,
            'price_per_day' => $data['price_per_day'] ?? null,
            'seats' => $data['seats'] ?? null,
            'fuel_type' => $data['fuel_type'] ?? null,
            'transmission' => $data['transmission'] ?? null,
            'featured' => (bool) ($data['featured'] ?? false),
            'description' => $data['description'] ?? null,
        ];

        $safe = [];
        foreach ($insert as $key => $value) {
            if (Schema::hasColumn('cars', $key)) {
                $safe[$key] = $value;
            }
        }

        Car::create($safe);

        return redirect('/admin/cars')->with('success', 'Car added successfully');
    }

    public function editCar($id) {
        $car = DB::table('cars')->where('id', $id)->first();
        return view('admin.edit_car', compact('car'));
    }

    public function updateCar(Request $request, $id) {
        if (!session()->has('admin')) return redirect('/admin');

        $car = Car::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'price_per_day' => 'nullable|numeric|min:0',
            'seats' => 'nullable|integer|min:1|max:60',
            'fuel_type' => 'nullable|string|max:50',
            'transmission' => 'nullable|string|max:50',
            'featured' => 'nullable|boolean',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,avif|max:4096',
        ]);

        if ($request->hasFile('image')) {
            if ($car->image && Str::startsWith($car->image, 'cars_uploads/')) {
                Storage::disk('public')->delete($car->image);
            }

            $car->image = $this->storeOptimizedCarImage($request->file('image'));
        }

        $car->name = $data['name'];
        $car->brand = $data['brand'];

        if (Schema::hasColumn('cars', 'price_per_day')) $car->price_per_day = $data['price_per_day'] ?? null;
        if (Schema::hasColumn('cars', 'seats')) $car->seats = $data['seats'] ?? null;
        if (Schema::hasColumn('cars', 'fuel_type')) $car->fuel_type = $data['fuel_type'] ?? null;
        if (Schema::hasColumn('cars', 'transmission')) $car->transmission = $data['transmission'] ?? null;
        if (Schema::hasColumn('cars', 'featured')) $car->featured = (bool) ($data['featured'] ?? false);
        if (Schema::hasColumn('cars', 'description')) $car->description = $data['description'] ?? null;
        $car->save();

        return redirect('/admin/cars')->with('success', 'Car updated successfully');
    }

    public function deleteCar($id) {
        DB::table('cars')->where('id', $id)->delete();
        return back();
    }

    public function bookings() {
        if (!session()->has('admin')) return redirect('/admin');

        $messages = DB::table('contacts')->get();
        return view('admin.bookings', compact('messages'));
    }

    public function deleteMessage($id) {
        $msg = Contact::find($id);
        if ($msg) $msg->delete();
        return back()->with('success', 'Message Deleted Successfully');
    }
}
