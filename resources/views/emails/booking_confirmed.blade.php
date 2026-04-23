<h2>Booking Confirmed</h2>

<p>Hi {{ $booking->name }},</p>

<p>Your car rental booking has been confirmed. Thank you for choosing us.</p>

<hr>

<p><strong>Booking ID:</strong> {{ $booking->booking_code ?: $booking->id }}</p>
<p><strong>Customer Name:</strong> {{ $booking->name }}</p>
<p><strong>Car Name:</strong> {{ $booking->carModel?->name ?? $booking->car }}</p>
<p><strong>Car Number Plate:</strong> {{ $booking->unit?->number_plate ?: 'Assigned at pickup' }}</p>

<p><strong>Pickup Date & Time:</strong>
    {{ $booking->pickup_at ? $booking->pickup_at->format('d M Y, H:i') : '—' }}
</p>
<p><strong>Drop Date & Time:</strong>
    {{ $booking->dropoff_at ? $booking->dropoff_at->format('d M Y, H:i') : '—' }}
</p>

<p><strong>Driver Name:</strong> {{ $booking->driver?->name ?: '—' }}</p>
<p><strong>Driver Mobile Number:</strong> {{ $booking->driver?->mobile ?: '—' }}</p>

<p><strong>Total Price:</strong> ₹{{ number_format($booking->total_amount ?? 0) }}</p>
<p><strong>Booking Status:</strong> Confirmed</p>

<hr>

@php
  $code = $booking->booking_code ?: (string) $booking->id;
  $phone = (string) ($booking->phone ?? '');
  $receiptView = url('/booking/receipt?code=' . urlencode($code) . '&phone=' . urlencode($phone));
  $receiptDownload = url('/booking/receipt?download=1&code=' . urlencode($code) . '&phone=' . urlencode($phone));
@endphp

<p><strong>Bill/Receipt:</strong></p>
<ul>
  <li><a href="{{ $receiptView }}" target="_blank" rel="noopener">View Bill</a></li>
  <li><a href="{{ $receiptDownload }}" target="_blank" rel="noopener">Download Bill (HTML)</a></li>
</ul>

<p>Thank you,</p>
<p><strong>Om Shanti Travels</strong></p>
