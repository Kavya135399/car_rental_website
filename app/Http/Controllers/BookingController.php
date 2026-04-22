<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\CarUnit;
use App\Services\CarAvailability;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function index()
    {
        return view('booking');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'car' => 'required',
            'car_id' => 'nullable|exists:cars,id',
            'name' => 'required',
            'phone' => 'required|digits:10',
            'email' => 'nullable|email',
            'passengers' => 'required|numeric|min:1',
            'payment_method' => 'required',
            'price_per_day' => 'required|numeric|min:0',
            'total_days' => 'required|numeric|min:1',
            'total_amount' => 'required|numeric|min:1',

            'date' => 'required|date',
            'pickup_time' => 'required|date_format:H:i',
            'return_date' => 'nullable|date',
            'drop_time' => 'nullable|date_format:H:i',

            'pickup' => 'nullable|string|max:255',
            'drop' => 'nullable|string|max:255',

            'payment_proof' => 'required_if:payment_method,UPI,Online|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $pickupAt = Carbon::parse($data['date'] . ' ' . $data['pickup_time']);
        $dropDate = $data['return_date'] ?? $data['date'];
        $dropTime = $data['drop_time'] ?? $data['pickup_time'];
        $dropoffAt = Carbon::parse($dropDate . ' ' . $dropTime);

        if ($dropoffAt->lessThanOrEqualTo($pickupAt)) {
            return back()->withErrors(['return_date' => 'Drop date/time must be after pickup date/time.'])->withInput();
        }

        $car = null;
        if (!empty($data['car_id'])) {
            $car = Car::find($data['car_id']);
        }
        if (!$car) {
            $car = Car::where('name', $data['car'])->first();
        }

        // File Upload
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $destination = public_path('payments');
            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            $file->move($destination, $filename);
            $data['payment_proof'] = $filename;
        } else {
            $data['payment_proof'] = null;
        }

        $hasStockTables =
            Schema::hasTable('car_units') &&
            Schema::hasTable('bookings') &&
            Schema::hasColumn('bookings', 'car_id') &&
            Schema::hasColumn('bookings', 'car_unit_id') &&
            Schema::hasColumn('bookings', 'pickup_at') &&
            Schema::hasColumn('bookings', 'dropoff_at') &&
            Schema::hasColumn('bookings', 'status');

        // Stock-aware booking when schema is ready (prevents overbooking)
        if ($car && $hasStockTables) {
            $booking = DB::transaction(function () use ($car, $data, $pickupAt, $dropoffAt, $request) {
                $blockingStatuses = CarAvailability::BLOCKING_STATUSES;

                $reservedUnit = CarUnit::query()
                    ->where('car_id', $car->id)
                    ->where('status', 'active')
                    ->whereNotIn('id', function ($q) use ($car, $pickupAt, $dropoffAt, $blockingStatuses) {
                        $q->select('car_unit_id')
                            ->from('bookings')
                            ->where('car_id', $car->id)
                            ->whereNotNull('car_unit_id')
                            ->whereIn('status', $blockingStatuses)
                            ->where('pickup_at', '<', $dropoffAt)
                            ->where('dropoff_at', '>', $pickupAt);
                    })
                    ->lockForUpdate()
                    ->first();

                if (!$reservedUnit) {
                    return null;
                }

                $bookingCode = 'BK-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6));

                $insert = [
                    'booking_code' => $bookingCode,
                    'status' => 'Pending',
                    'car_id' => $car->id,
                    'car_unit_id' => $reservedUnit->id,

                    'car' => $data['car'],
                    'price_per_day' => $data['price_per_day'],
                    'passengers' => $data['passengers'],
                    'name' => $data['name'],
                    'phone' => $data['phone'],
                    'email' => $data['email'] ?? null,
                    'pickup' => $data['pickup'] ?? null,
                    'drop' => $data['drop'] ?? null,
                    'date' => $data['date'],
                    'pickup_time' => $data['pickup_time'],
                    'return_date' => $data['return_date'] ?? null,
                    'total_days' => $data['total_days'],
                    'total_amount' => $data['total_amount'],
                    'payment_method' => $data['payment_method'],
                    'payment_proof' => $data['payment_proof'],
                    'message' => $request->message,

                    'pickup_at' => $pickupAt,
                    'dropoff_at' => $dropoffAt,
                    'pickup_location' => $data['pickup'] ?? null,
                    'dropoff_location' => $data['drop'] ?? null,
                ];

                // If some columns aren't migrated yet, avoid SQL errors.
                $safe = [];
                foreach ($insert as $key => $value) {
                    if (Schema::hasColumn('bookings', $key)) {
                        $safe[$key] = $value;
                    }
                }

                return Booking::create($safe);
            });

            if (!$booking) {
                return back()->with('error', 'THIS CAR NOT AVAILABLE NOW')->withInput();
            }

            return back()->with('success', 'Booking submitted successfully! Booking ID: ' . ($booking->booking_code ?? $booking->id));
        }

        // Legacy save (works even if new columns are not migrated yet)
        $insert = [
            'status' => 'Pending',
            'car' => $data['car'],
            'price_per_day' => $data['price_per_day'],
            'passengers' => $data['passengers'],
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'] ?? null,
            'pickup' => $data['pickup'] ?? null,
            'drop' => $data['drop'] ?? null,
            'date' => $data['date'],
            'pickup_time' => $data['pickup_time'],
            'return_date' => $data['return_date'] ?? null,
            'total_days' => $data['total_days'],
            'total_amount' => $data['total_amount'],
            'payment_method' => $data['payment_method'],
            'payment_proof' => $data['payment_proof'],
            'message' => $request->message,
            'pickup_at' => $pickupAt,
            'dropoff_at' => $dropoffAt,
            'pickup_location' => $data['pickup'] ?? null,
            'dropoff_location' => $data['drop'] ?? null,
        ];

        $safe = [];
        foreach ($insert as $key => $value) {
            if (Schema::hasColumn('bookings', $key)) {
                $safe[$key] = $value;
            }
        }

        $booking = Booking::create($safe);

        return back()->with('success', 'Booking submitted successfully! Booking ID: ' . ($booking->booking_code ?? $booking->id));
    }
}
