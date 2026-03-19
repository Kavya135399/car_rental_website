<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking; // ✅ IMPORTANT

class BookingController extends Controller
{
    public function index()
    {
        return view('booking');
    }

    public function store(Request $request)
{
    // ✅ Validation (FIXED PROPERLY)
    $data = $request->validate([
        'car' => 'required',
        'name' => 'required',
        'phone' => 'required|digits:10',
        'passengers' => 'required|numeric|min:1',
        'payment_method' => 'required',
        'price_per_day' => 'required',
        'total_days' => 'required|numeric|min:1',
        'total_amount' => 'required|numeric|min:1',

        // ✅ FIXED (no nullable)
        'payment_proof' => 'required_if:payment_method,UPI,Online|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    // ✅ File Upload
    if ($request->hasFile('payment_proof')) {

        $file = $request->file('payment_proof');

        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // create folder if not exists
        $destination = public_path('payments');
        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);
        }

        $file->move($destination, $filename);

        $data['payment_proof'] = $filename;

    } else {
        $data['payment_proof'] = null;
    }

    // ✅ Save to DB
    Booking::create([
        'car' => $data['car'],
        'price_per_day' => $data['price_per_day'],
        'passengers' => $data['passengers'],
        'name' => $data['name'],
        'phone' => $data['phone'],
        'email' => $request->email,
        'pickup' => $request->pickup,
        'drop' => $request->drop,
        'date' => $request->date,
        'pickup_time' => $request->pickup_time,
        'return_date' => $request->return_date,
        'total_days' => $data['total_days'],
        'total_amount' => $data['total_amount'],
        'payment_method' => $data['payment_method'],
        'payment_proof' => $data['payment_proof'],
        'message' => $request->message,
    ]);

    return back()->with('success', 'Booking submitted successfully!');
}
}