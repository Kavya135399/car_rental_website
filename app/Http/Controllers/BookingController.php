<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\CarUnit;
use App\Services\CarAvailability;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function index()
    {
        return view('booking');
    }

    public function statusForm(Request $request)
    {
        return view('booking-status', [
            'code' => (string) ($request->query('code', '')),
            'phone' => (string) ($request->query('phone', '')),
            'booking' => null,
        ]);
    }

    public function statusLookup(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|max:40',
            'phone' => 'required|digits:10',
        ]);

        $code = trim((string) $data['code']);

        $query = Booking::query()->where('phone', $data['phone']);
        if (ctype_digit($code)) {
            $query->where('id', (int) $code);
        } else {
            $query->where('booking_code', $code);
        }

        $booking = $query->first();

        if (!$booking) {
            return back()->withErrors(['code' => 'Booking not found for this phone number.'])->withInput();
        }

        return view('booking-status', [
            'code' => $code,
            'phone' => $data['phone'],
            'booking' => $booking,
        ]);
    }

    public function receipt(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|max:40',
            'phone' => 'required|digits:10',
            'download' => 'nullable|boolean',
        ]);

        $code = trim((string) $data['code']);

        $query = Booking::query()->where('phone', $data['phone']);
        if (ctype_digit($code)) {
            $query->where('id', (int) $code);
        } else {
            $query->where('booking_code', $code);
        }

        $booking = $query->first();
        if (!$booking) {
            abort(404, 'Booking not found.');
        }

        $paymentMethod = (string) ($booking->payment_method ?? '');
        $paymentStatus = (string) ($booking->payment_status ?? (($paymentMethod === 'Cash') ? 'Cash' : 'Unpaid'));
        $receiptAllowed =
            (in_array($paymentStatus, ['Paid', 'Cash', 'Refunded', 'Refund Initiated'], true)) ||
            (in_array($paymentMethod, ['UPI', 'Online'], true) && !empty($booking->payment_utr) && $paymentStatus !== 'Rejected');

        if (!$receiptAllowed) {
            return redirect('/booking/status?code=' . urlencode($code) . '&phone=' . urlencode($data['phone']))
                ->withErrors(['code' => 'Receipt is available after submitting a valid UTR (UPI/Online) or after payment is marked Paid/Cash.']);
        }

        if (Schema::hasColumn('bookings', 'receipt_number') && empty($booking->receipt_number)) {
            $prefix = 'RCP-' . now()->format('Ymd') . '-';
            for ($i = 0; $i < 5; $i++) {
                $candidate = $prefix . Str::upper(Str::random(8));
                if (!Booking::query()->where('receipt_number', $candidate)->exists()) {
                    $booking->receipt_number = $candidate;
                    break;
                }
            }
        }

        if (Schema::hasColumn('bookings', 'receipt_generated_at') && empty($booking->receipt_generated_at)) {
            $booking->receipt_generated_at = now();
        }

        if ($booking->isDirty()) {
            $booking->save();
        }

        $viewData = [
            'booking' => $booking,
            'code' => $code,
            'phone' => $data['phone'],
            'payment_status' => $paymentStatus,
            'is_provisional' => !in_array($paymentStatus, ['Paid', 'Cash'], true),
        ];

        $filename = 'receipt-' . preg_replace('/[^A-Za-z0-9\\-_.]+/', '_', (string) ($booking->booking_code ?: $booking->id)) . '.html';
        if (!empty($data['download'])) {
            return response()
                ->view('receipts.booking', $viewData)
                ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
        }

        return view('receipts.booking', $viewData);
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
            'payment_utr' => 'nullable|required_if:payment_method,UPI|string|min:6|max:64|regex:/^[A-Za-z0-9]+$/',
            'amount_paid' => 'nullable|required_if:payment_method,UPI|numeric|min:1',
            'online_payment_terms' => 'nullable|accepted_if:payment_method,UPI,Online',
            'price_per_day' => 'required|numeric|min:0',
            'total_days' => 'required|numeric|min:1',
            'total_amount' => 'required|numeric|min:1',

            'date' => 'required|date',
            'pickup_time' => 'required|date_format:H:i',
            'return_date' => 'nullable|date',
            'drop_time' => 'nullable|date_format:H:i',

            'pickup' => 'nullable|string|max:255',
            'drop' => 'nullable|string|max:255',
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

        // This project used to upload a payment screenshot. The new flow uses UTR only.
        $data['payment_proof'] = null;
        $data['payment_utr'] = isset($data['payment_utr']) ? strtoupper(trim($data['payment_utr'])) : null;
        if (($data['payment_method'] ?? null) === 'Cash') {
            $data['payment_utr'] = null;
            $data['payment_status'] = 'Cash';
            $data['amount_paid'] = 0;
            $data['payment_gateway'] = null;
        } else {
            if (($data['payment_method'] ?? null) === 'Online') {
                $data['payment_status'] = 'Pending Payment';
                $data['payment_gateway'] = 'razorpay';
                $data['payment_utr'] = null;
                $data['amount_paid'] = round(((float) $data['total_amount']) * 0.5, 2); // advance
            } else {
                $data['payment_status'] = $data['payment_utr'] ? 'UTR Submitted' : 'Unpaid';
                $data['payment_gateway'] = null;
            }
        }
        $data['online_payment_terms_accepted_at'] = null;
        if (in_array((string) ($data['payment_method'] ?? ''), ['UPI', 'Online'], true) && !empty($data['online_payment_terms'])) {
            $data['online_payment_terms_accepted_at'] = now();
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
                    'payment_utr' => $data['payment_utr'],
                    'payment_status' => $data['payment_status'],
                    'amount_paid' => $data['amount_paid'] ?? 0,
                    'online_payment_terms_accepted_at' => $data['online_payment_terms_accepted_at'],
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

            $code = $booking->booking_code ?? (string) $booking->id;
            if (($data['payment_method'] ?? null) === 'Online') {
                return redirect('/payment/online?code=' . urlencode($code) . '&phone=' . urlencode($booking->phone));
            }

            return redirect('/booking/status?code=' . urlencode($code) . '&phone=' . urlencode($booking->phone))
                ->with('success', 'Booking submitted successfully! Booking ID: ' . $code);
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
            'payment_utr' => $data['payment_utr'],
            'payment_status' => $data['payment_status'],
            'amount_paid' => $data['amount_paid'] ?? 0,
            'online_payment_terms_accepted_at' => $data['online_payment_terms_accepted_at'],
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

        $code = $booking->booking_code ?? (string) $booking->id;
        if (($data['payment_method'] ?? null) === 'Online') {
            return redirect('/payment/online?code=' . urlencode($code) . '&phone=' . urlencode($booking->phone));
        }

        return redirect('/booking/status?code=' . urlencode($code) . '&phone=' . urlencode($booking->phone))
            ->with('success', 'Booking submitted successfully! Booking ID: ' . $code);
    }

    public function onlineCheckout(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|max:40',
            'phone' => 'required|digits:10',
        ]);

        $code = trim((string) $data['code']);

        $query = Booking::query()->where('phone', $data['phone']);
        if (ctype_digit($code)) {
            $query->where('id', (int) $code);
        } else {
            $query->where('booking_code', $code);
        }

        $booking = $query->first();
        if (!$booking) {
            abort(404, 'Booking not found.');
        }

        if (($booking->payment_method ?? null) !== 'Online') {
            return redirect('/booking/status?code=' . urlencode($code) . '&phone=' . urlencode($data['phone']))
                ->withErrors(['code' => 'This booking is not an online payment booking.']);
        }

        if (($booking->payment_status ?? null) === 'Paid') {
            return redirect('/booking/status?code=' . urlencode($code) . '&phone=' . urlencode($data['phone']))
                ->with('success', 'Payment already completed.');
        }

        $keyId = (string) config('payments.razorpay.key_id');
        $secret = (string) config('payments.razorpay.key_secret');
        if ($keyId === '' || $secret === '') {
            return redirect('/booking/status?code=' . urlencode($code) . '&phone=' . urlencode($data['phone']))
                ->withErrors(['code' => 'Online payments are not configured. Please set RAZORPAY_KEY_ID and RAZORPAY_KEY_SECRET in .env.']);
        }

        // Create Razorpay order if missing
        if (Schema::hasColumn('bookings', 'gateway_order_id') && empty($booking->gateway_order_id)) {
            try {
                $amountPaise = (int) round(((float) ($booking->amount_paid ?? 0)) * 100);
                if ($amountPaise <= 0) {
                    $amountPaise = (int) round(((float) ($booking->total_amount ?? 0)) * 50); // fallback 50%
                }

                $resp = Http::withBasicAuth($keyId, $secret)
                    ->acceptJson()
                    ->post('https://api.razorpay.com/v1/orders', [
                        'amount' => $amountPaise,
                        'currency' => 'INR',
                        'receipt' => (string) ($booking->booking_code ?: $booking->id),
                        'notes' => [
                            'booking_id' => (string) $booking->id,
                            'booking_code' => (string) ($booking->booking_code ?: ''),
                            'phone' => (string) ($booking->phone ?? ''),
                        ],
                    ]);

                if (!$resp->successful()) {
                    return redirect('/booking/status?code=' . urlencode($code) . '&phone=' . urlencode($data['phone']))
                        ->withErrors(['code' => 'Could not create payment order. Try again later.']);
                }

                $json = $resp->json();
                $booking->gateway_order_id = (string) ($json['id'] ?? '');
                if (Schema::hasColumn('bookings', 'payment_gateway') && empty($booking->payment_gateway)) {
                    $booking->payment_gateway = 'razorpay';
                }
                $booking->save();
            } catch (\Throwable $e) {
                return redirect('/booking/status?code=' . urlencode($code) . '&phone=' . urlencode($data['phone']))
                    ->withErrors(['code' => 'Payment gateway error: ' . $e->getMessage()]);
            }
        }

        return view('payments.razorpay-checkout', [
            'booking' => $booking,
            'code' => $code,
            'phone' => $data['phone'],
            'razorpay_key_id' => $keyId,
        ]);
    }

    public function razorpayVerify(Request $request)
    {
        $data = $request->validate([
            'booking_id' => 'required|integer',
            'code' => 'required|string|max:40',
            'phone' => 'required|digits:10',
            'razorpay_order_id' => 'required|string|max:120',
            'razorpay_payment_id' => 'required|string|max:120',
            'razorpay_signature' => 'required|string|max:256',
        ]);

        $booking = Booking::query()
            ->where('id', (int) $data['booking_id'])
            ->where('phone', $data['phone'])
            ->firstOrFail();

        if (($booking->payment_method ?? null) !== 'Online') {
            return redirect('/booking/status?code=' . urlencode($data['code']) . '&phone=' . urlencode($data['phone']))
                ->withErrors(['code' => 'This booking is not an online payment booking.']);
        }

        $secret = (string) config('payments.razorpay.key_secret');
        if ($secret === '') {
            return redirect('/booking/status?code=' . urlencode($data['code']) . '&phone=' . urlencode($data['phone']))
                ->withErrors(['code' => 'Online payments are not configured.']);
        }

        $payload = (string) $data['razorpay_order_id'] . '|' . (string) $data['razorpay_payment_id'];
        $expected = hash_hmac('sha256', $payload, $secret);
        if (!hash_equals($expected, (string) $data['razorpay_signature'])) {
            return redirect('/payment/online?code=' . urlencode($data['code']) . '&phone=' . urlencode($data['phone']))
                ->withErrors(['code' => 'Payment verification failed. Please try again or contact support.']);
        }

        if (Schema::hasColumn('bookings', 'gateway_order_id')) {
            $booking->gateway_order_id = (string) $data['razorpay_order_id'];
        }
        if (Schema::hasColumn('bookings', 'gateway_payment_id')) {
            $booking->gateway_payment_id = (string) $data['razorpay_payment_id'];
        }
        if (Schema::hasColumn('bookings', 'gateway_signature')) {
            $booking->gateway_signature = (string) $data['razorpay_signature'];
        }
        if (Schema::hasColumn('bookings', 'payment_gateway') && empty($booking->payment_gateway)) {
            $booking->payment_gateway = 'razorpay';
        }

        $booking->payment_status = 'Paid';
        if (Schema::hasColumn('bookings', 'payment_verified_at')) {
            $booking->payment_verified_at = now();
        }
        $booking->save();

        return redirect('/booking/status?code=' . urlencode($data['code']) . '&phone=' . urlencode($data['phone']))
            ->with('success', 'Payment verified successfully.');
    }
}
