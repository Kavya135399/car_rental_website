<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;

class AdminController extends Controller
{
    // Login view
    public function login() {
        return view('admin.login');
    }

    // Logout
    public function logout(Request $request) {
        Session::flush(); // destroy session
        return redirect('/admin');
    }

    // Login check
    public function loginCheck(Request $request) {
        if ($request->email == "admin@gmail.com" && $request->password == "1234") {
            return redirect('/admin/dashboard');
        }
        return back()->with('error','Invalid Login');
    }

    // Dashboard
    public function dashboard() {

        // CARD COUNTS
        $totalCars = DB::table('cars')->count();
        $totalBookings = DB::table('contacts')->count(); // Using contacts as "bookings"
        $totalCustomers = DB::table('contacts')->count(); // Contacts as customers
        $totalMessages = DB::table('contacts')->count(); // Messages from contacts

        // RECENT ACTIVITIES (last 5 interactions)
        $recentActivities = [];
        $latestContacts = DB::table('contacts')
                            ->orderBy('created_at', 'desc')
                            ->limit(5)
                            ->get(['name']);
        foreach($latestContacts as $c) {
            $recentActivities[] = "{$c->name} sent a contact message";
        }

        // CUSTOMER GROWTH CHART (monthly)
        $customers = DB::table('contacts')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(id) as total'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = [];
        $totals = [];
        foreach($customers as $c) {
            $months[] = date("M", mktime(0,0,0,$c->month,10));
            $totals[] = $c->total;
        }

        // BOOKINGS CHART (same as customers, since no bookings table)
        $bookingMonths = $months;
        $bookingTotals = $totals;

        return view('admin.dashboard', compact(
            'totalCars',
            'totalBookings',
            'totalCustomers',
            'totalMessages',
            'recentActivities',
            'months',
            'totals',
            'bookingMonths',
            'bookingTotals'
        ));
    }

    // Cars
    public function cars() {
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

    // Bookings / Contacts
    public function bookings() {
        $messages = DB::table('contacts')->get();
        return view('admin.bookings', compact('messages'));
    }
}