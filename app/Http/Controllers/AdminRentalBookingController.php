<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Driver;
use App\Mail\BookingConfirmedMail;
use App\Mail\PaymentRejectedMail;
use App\Services\CarAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;

class AdminRentalBookingController extends Controller
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

        $schemaReady =
            Schema::hasTable('bookings') &&
            Schema::hasColumn('bookings', 'status') &&
            Schema::hasColumn('bookings', 'pickup_at') &&
            Schema::hasColumn('bookings', 'dropoff_at');

        if (!$schemaReady) {
            return view('admin.rentals', [
                'bookings' => collect(),
                'drivers' => collect(),
                'schemaReady' => false,
            ]);
        }

        $bookings = Booking::query()
            ->with(['carModel', 'unit', 'driver'])
            ->orderByDesc('id')
            ->limit(200)
            ->get();

        $drivers = Schema::hasTable('drivers')
            ? Driver::query()->where('is_active', true)->orderBy('name')->get()
            : collect();

        return view('admin.rentals', [
            'bookings' => $bookings,
            'drivers' => $drivers,
            'schemaReady' => true,
        ]);
    }

    public function confirm(Request $request, $id)
    {
        if ($redirect = $this->requireAdmin()) return $redirect;

        if (!Schema::hasTable('bookings') || !Schema::hasTable('drivers')) {
            return back()->with('error', 'Required tables are missing. Run migrations first.');
        }

        $booking = Booking::with(['carModel', 'unit', 'driver'])->findOrFail($id);

        $data = $request->validate([
            'driver_id' => 'required|exists:drivers,id',
        ]);

        if (!$booking->pickup_at || !$booking->dropoff_at) {
            return back()->with('error', 'Booking is missing pickup/drop times.');
        }

        $blocking = CarAvailability::BLOCKING_STATUSES;
        $driverBusy = Booking::query()
            ->where('driver_id', $data['driver_id'])
            ->whereIn('status', $blocking)
            ->where('pickup_at', '<', $booking->dropoff_at)
            ->where('dropoff_at', '>', $booking->pickup_at)
            ->where('id', '!=', $booking->id)
            ->exists();

        if ($driverBusy) {
            return back()->with('error', 'Driver is busy in the selected time slot.');
        }

        $booking->driver_id = (int) $data['driver_id'];
        $booking->status = 'Confirmed';
        $booking->save();

        $booking->load(['carModel', 'unit', 'driver']);

        if (!empty($booking->email)) {
            $mailer = config('mail.default');
            try {
                Mail::to($booking->email)->send(new BookingConfirmedMail($booking));
            } catch (\Throwable $e) {
                return back()->with('error', 'Booking confirmed, but email failed to send: ' . $e->getMessage());
            }

            // Laravel default in this project is MAIL_MAILER=log, which does not actually deliver email.
            if (in_array($mailer, ['log', 'array', 'null'], true)) {
                return back()->with('success', "Booking confirmed and driver assigned. Email was not delivered because MAIL_MAILER={$mailer}. Check storage/logs/laravel.log or configure SMTP in .env.");
            }
        }

        if (!empty($booking->email)) {
            return back()->with('success', 'Booking confirmed and driver assigned. Confirmation email sent.');
        }

        return back()->with('success', 'Booking confirmed and driver assigned. (No customer email on booking)');
    }

    public function status(Request $request, $id)
    {
        if ($redirect = $this->requireAdmin()) return $redirect;

        if (!Schema::hasTable('bookings') || !Schema::hasColumn('bookings', 'status')) {
            return back()->with('error', 'Bookings status column not found. Run migrations first.');
        }

        $booking = Booking::findOrFail($id);
        $data = $request->validate([
            'status' => 'required|in:Pending,Confirmed,In Use,Completed,Cancelled',
        ]);

        $booking->status = $data['status'];
        $booking->save();

        return back()->with('success', 'Status updated');
    }

    public function verifyPayment(Request $request, $id)
    {
        if ($redirect = $this->requireAdmin()) return $redirect;

        if (!Schema::hasTable('bookings') || !Schema::hasColumn('bookings', 'payment_status')) {
            return back()->with('error', 'Payment columns not found. Run migrations first.');
        }

        $data = $request->validate([
            'admin_utr' => 'required|string|size:12|regex:/^[0-9]{12}$/',
        ]);

        $booking = Booking::findOrFail($id);

        if (($booking->payment_method ?? null) !== 'UPI') {
            return back()->with('error', 'UTR verification is only for UPI bookings.');
        }

        if (($booking->payment_status ?? null) === 'Paid') {
            return back()->with('success', 'Payment is already marked as Paid.');
        }

        $userUtr = strtoupper(trim((string) ($booking->payment_utr ?? '')));
        $adminUtr = strtoupper(trim((string) $data['admin_utr']));

        if ($userUtr === '') {
            return back()->with('error', 'User has not submitted a UTR for this booking.');
        }

        if ($userUtr !== $adminUtr) {
            return back()->with('error', 'UTR mismatch. Please double-check your UPI statement and the user UTR.');
        }

        $booking->payment_status = 'Paid';
        if (Schema::hasColumn('bookings', 'payment_verified_at')) {
            $booking->payment_verified_at = now();
        }
        if (Schema::hasColumn('bookings', 'payment_verified_by')) {
            $booking->payment_verified_by = (int) session('admin');
        }
        $booking->save();

        return back()->with('success', 'Payment verified (UTR matched).');
    }

    public function rejectPayment(Request $request, $id)
    {
        if ($redirect = $this->requireAdmin()) return $redirect;

        if (!Schema::hasTable('bookings') || !Schema::hasColumn('bookings', 'payment_status')) {
            return back()->with('error', 'Payment columns not found. Run migrations first.');
        }

        $booking = Booking::findOrFail($id);
        $booking->payment_status = 'Rejected';
        if (Schema::hasColumn('bookings', 'payment_verified_at')) {
            $booking->payment_verified_at = null;
        }
        if (Schema::hasColumn('bookings', 'payment_verified_by')) {
            $booking->payment_verified_by = null;
        }
        $booking->save();

        if (!empty($booking->email)) {
            $mailer = config('mail.default');
            try {
                Mail::to($booking->email)->send(new PaymentRejectedMail($booking));
            } catch (\Throwable $e) {
                return back()->with('error', 'Payment marked as rejected, but email failed to send: ' . $e->getMessage());
            }

            if (in_array($mailer, ['log', 'array', 'null'], true)) {
                return back()->with('success', "Payment marked as rejected. Email was not delivered because MAIL_MAILER={$mailer}. Check storage/logs/laravel.log or configure SMTP in .env.");
            }
        }

        return back()->with('success', 'Payment marked as rejected.');
    }

    public function refundPayment(Request $request, $id)
    {
        if ($redirect = $this->requireAdmin()) return $redirect;

        if (!Schema::hasTable('bookings') || !Schema::hasColumn('bookings', 'payment_status')) {
            return back()->with('error', 'Payment columns not found. Run migrations first.');
        }

        $data = $request->validate([
            'refund_amount' => 'nullable|numeric|min:1',
        ]);

        $booking = Booking::findOrFail($id);

        if (($booking->payment_status ?? null) !== 'Paid' && ($booking->payment_status ?? null) !== 'Cash') {
            return back()->with('error', 'Refund can be initiated only for Paid/Cash bookings.');
        }

        $amount = isset($data['refund_amount']) ? (float) $data['refund_amount'] : 0.0;
        if ($amount <= 0) {
            $amount = (float) ($booking->amount_paid ?? 0);
            if ($amount <= 0) {
                $amount = (float) ($booking->total_amount ?? 0);
            }
        }

        // Automatic refund only for Razorpay online payments
        $gateway = (string) ($booking->payment_gateway ?? '');
        $paymentId = (string) ($booking->gateway_payment_id ?? '');
        if ($gateway !== 'razorpay' || $paymentId === '') {
            if (Schema::hasColumn('bookings', 'refund_amount')) $booking->refund_amount = $amount;
            if (Schema::hasColumn('bookings', 'refund_status')) $booking->refund_status = 'manual';
            if (Schema::hasColumn('bookings', 'refunded_at')) $booking->refunded_at = now();
            $booking->payment_status = 'Refunded';
            $booking->save();

            return back()->with('success', 'Refund marked as Refunded (manual).');
        }

        $keyId = (string) config('payments.razorpay.key_id');
        $secret = (string) config('payments.razorpay.key_secret');
        if ($keyId === '' || $secret === '') {
            return back()->with('error', 'Razorpay not configured. Set RAZORPAY_KEY_ID and RAZORPAY_KEY_SECRET.');
        }

        try {
            $payload = [];
            $amountPaise = (int) round($amount * 100);
            if ($amountPaise > 0) {
                $payload['amount'] = $amountPaise;
            }

            $resp = Http::withBasicAuth($keyId, $secret)
                ->acceptJson()
                ->post('https://api.razorpay.com/v1/payments/' . urlencode($paymentId) . '/refund', $payload);

            if (!$resp->successful()) {
                return back()->with('error', 'Refund failed. Please try again later.');
            }

            $json = $resp->json();
            $refundId = (string) ($json['id'] ?? '');
            $refundStatus = (string) ($json['status'] ?? 'created');

            if (Schema::hasColumn('bookings', 'refund_id')) $booking->refund_id = $refundId !== '' ? $refundId : null;
            if (Schema::hasColumn('bookings', 'refund_amount')) $booking->refund_amount = $amount;
            if (Schema::hasColumn('bookings', 'refund_status')) $booking->refund_status = $refundStatus;
            if (Schema::hasColumn('bookings', 'refunded_at')) $booking->refunded_at = now();

            $booking->payment_status = ($refundStatus === 'processed') ? 'Refunded' : 'Refund Initiated';
            $booking->save();

            return back()->with('success', 'Refund initiated successfully.');
        } catch (\Throwable $e) {
            return back()->with('error', 'Refund error: ' . $e->getMessage());
        }
    }
}
