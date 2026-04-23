<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Payment Rejected</title>
</head>
<body style="font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;background:#f3f4f6;margin:0;padding:18px;">
  @php
    $code = $booking->booking_code ?: (string) $booking->id;
    $statusUrl = url('/booking/status?code=' . urlencode($code) . '&phone=' . urlencode((string) ($booking->phone ?? '')));
    $bookUrl = url('/booking');
  @endphp

  <div style="max-width:720px;margin:0 auto;background:#ffffff;border:1px solid #e5e7eb;border-radius:14px;padding:18px;">
    <h2 style="margin:0 0 8px 0;">Your payment was rejected</h2>
    <p style="margin:0;color:#374151;">
      Hello {{ $booking->name ?: 'Customer' }}, your payment for booking <strong>{{ $code }}</strong> was rejected by the admin.
    </p>

    <p style="margin:12px 0 0 0;color:#374151;">
      Please try again with the correct UTR / payment reference, or make a new booking.
    </p>

    <div style="margin-top:16px;">
      <a href="{{ $statusUrl }}" style="display:inline-block;padding:10px 12px;border-radius:12px;background:#2563eb;color:#fff;text-decoration:none;font-weight:700;">Check Status</a>
      <a href="{{ $bookUrl }}" style="display:inline-block;padding:10px 12px;border-radius:12px;border:1px solid #e5e7eb;color:#111827;text-decoration:none;font-weight:700;margin-left:10px;">Book Now</a>
    </div>

    <p style="margin:16px 0 0 0;color:#6b7280;font-size:13px;">
      If you believe this is a mistake, reply to this email with your UTR and a screenshot of the payment.
    </p>
  </div>
</body>
</html>

