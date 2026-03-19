<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
use App\Models\Contact;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    // =========================
    // Login view
    // =========================
    public function login() {
        return view('admin.login');
    }

    // =========================
    // Logout
    // =========================
    public function logout() {
        session()->forget('admin_login');
        return redirect('/admin');
    }

    // =========================
    // Login check
    // =========================
    // public function loginCheck(Request $request) {
    //     if ($request->email == "admin@gmail.com" && $request->password == "1234") {
    //         session(['admin_login' => true]); // create admin session
    //         return redirect('/admin/dashboard');
    //     }
    //     return back()->with('error', 'Invalid Login');
    // }
// public function loginCheck(Request $request)
// {
//     $user = User::where('email',$request->email)->first();

//     // if($user && Hash::check($request->password,$user->password))
//     if($user && $request->password == $user->password)
//     {
//         session(['admin_login'=>true]);
//         return redirect('/admin/dashboard');
//     }

//     return back()->with('error','Invalid Email or Password');
// }

public function loginCheck(Request $request)
{
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->with('error', 'User not found');
    }

    // ✅ CORRECT WAY
    if (!Hash::check($request->password, $user->password)) {
        return back()->with('error', 'Wrong password');
    }

    // login success
    session(['admin' => $user->id]);

    return redirect('/admin/dashboard');
}
    // =========================
    // Dashboard
    // =========================
    public function dashboard() {
        if (!session()->has('admin_login')) {
            return redirect('/admin'); // redirect to login
        }

        // CARD COUNTS
        $totalCars = DB::table('cars')->count();
        $totalBookings = DB::table('contacts')->count();
        $totalCustomers = DB::table('contacts')->count();
        $totalMessages = DB::table('contacts')->count();

        // LATEST REVIEWS
        $reviews = Review::latest()->take(5)->get();

        // RECENT ACTIVITIES
        $recentActivities = [];
        $latestContacts = DB::table('contacts')
                            ->orderBy('created_at', 'desc')
                            ->limit(5)
                            ->get(['name']);
        foreach ($latestContacts as $c) {
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
        foreach ($customers as $c) {
            $months[] = date("M", mktime(0,0,0,$c->month,10));
            $totals[] = $c->total;
        }

        // BOOKINGS CHART (reuse same data)
        $bookingMonths = $months;
        $bookingTotals = $totals;

        // RETURN VIEW WITH ALL VARIABLES
        return view('admin.dashboard', compact(
            'totalCars',
            'totalBookings',
            'totalCustomers',
            'totalMessages',
            'reviews',
            'recentActivities',
            'months',
            'totals',
            'bookingMonths',
            'bookingTotals'
        ));
    }

    // =========================
    // Cars CRUD
    // =========================
    public function cars() {
        if (!session()->has('admin_login')) {
            return redirect('/admin');
        }

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

    // =========================
    // Bookings / Contacts
    // =========================
    public function bookings() {
        if (!session()->has('admin_login')) {
            return redirect('/admin');
        }

        $messages = DB::table('contacts')->get();
        return view('admin.bookings', compact('messages'));
    }

    public function deleteMessage($id) {
        $msg = Contact::find($id);

        if ($msg) {
            $msg->delete();
        }

        return redirect()->back()->with('success', 'Message Deleted Successfully');
    }
}