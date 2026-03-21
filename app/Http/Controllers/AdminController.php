<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Review;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
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
    $totalBookings = DB::table('contacts')->count();
    $totalCustomers = DB::table('contacts')->count();
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
    $bookings = DB::table('contacts')  // or table you use for bookings
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

        $cars = DB::table('cars')->get();
        return view('admin.cars', compact('cars'));
    }

    public function addCar() {
        return view('admin.add_car');
    }

    public function saveCar(Request $request) {
        DB::table('cars')->insert([
            'name' => $request->name,
            'brand' => $request->brand,
            'image' => $request->image
        ]);
        return redirect('/admin/cars');
    }

    public function editCar($id) {
        $car = DB::table('cars')->where('id', $id)->first();
        return view('admin.edit_car', compact('car'));
    }

    public function updateCar(Request $request, $id) {
        DB::table('cars')->where('id', $id)->update([
            'name' => $request->name,
            'brand' => $request->brand,
            'image' => $request->image
        ]);
        return redirect('/admin/cars');
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