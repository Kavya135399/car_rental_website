<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Driver;
use App\Mail\BookingConfirmedMail;
use App\Services\CarAvailability;
use Illuminate\Http\Request;
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
}
