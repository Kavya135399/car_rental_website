<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pay Online - Om Shanti Travels</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <style>
    .pay-card{background:#fff;border-radius:14px;box-shadow:0 10px 25px rgba(0,0,0,0.08);padding:22px;}
    .muted{color:#6b7280;font-size:13px;}
    .kv{display:flex;gap:10px;flex-wrap:wrap;margin-top:10px;}
    .kv > div{flex:1;min-width:220px;background:#f8fafc;border:1px solid #e5e7eb;border-radius:12px;padding:12px;}
    .btn{display:inline-block;padding:12px 14px;border-radius:12px;border:none;background:#2563eb;color:#fff;font-weight:800;cursor:pointer;text-decoration:none;}
    .btn.outline{background:#fff;color:#111827;border:1px solid #e5e7eb;}
    .pill{display:inline-block;padding:6px 10px;border-radius:999px;font-size:12px;border:1px solid rgba(0,0,0,0.08);background:#f8fafc;}
    .warn{background:rgba(245,158,11,.12);color:#92400e;border-color:rgba(245,158,11,.25);}
  </style>
</head>
<body style="background:#f3f4f6;">
  <div style="max-width:950px;margin:22px auto;padding:0 14px;">
    <div class="pay-card">
      <h3 style="margin:0 0 8px 0;">Online Payment</h3>
      <div class="muted">Complete your payment to confirm. Booking ID: <strong>{{ $booking->booking_code ?: ('#' . $booking->id) }}</strong></div>

      @if($errors->any())
        <div style="margin-top:12px;" class="pill warn">{{ $errors->first() }}</div>
      @endif

      <div class="kv">
        <div>
          <div class="muted">Customer</div>
          <div style="font-weight:800;margin-top:6px;">{{ $booking->name }}</div>
          <div class="muted" style="margin-top:6px;">{{ $booking->phone }}</div>
        </div>
        <div>
          <div class="muted">Payable (Advance)</div>
          <div style="font-weight:900;font-size:18px;margin-top:6px;">₹{{ number_format((float) ($booking->amount_paid ?? 0), 2) }}</div>
          <div class="muted" style="margin-top:6px;">Total: ₹{{ number_format((float) ($booking->total_amount ?? 0), 2) }}</div>
        </div>
        <div>
          <div class="muted">Status</div>
          <div style="font-weight:800;margin-top:6px;">{{ $booking->payment_status ?: 'Pending' }}</div>
          <div class="muted" style="margin-top:6px;">Method: Online</div>
        </div>
      </div>

      <div style="margin-top:14px;display:flex;gap:10px;flex-wrap:wrap;">
        <button class="btn" id="payNowBtn">Pay Now</button>
        <a class="btn outline" href="{{ url('/booking/status?code=' . urlencode($code) . '&phone=' . urlencode($phone)) }}">Back to Status</a>
      </div>

      <div class="muted" style="margin-top:12px;">
        Choose any method (UPI / Card / Netbanking / Wallet) in checkout. After successful payment, your booking will be marked <strong>Paid</strong> automatically and you can download the bill.
      </div>
    </div>
  </div>

  <form id="verifyForm" method="POST" action="{{ url('/payment/razorpay/verify') }}" style="display:none;">
    @csrf
    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
    <input type="hidden" name="code" value="{{ $code }}">
    <input type="hidden" name="phone" value="{{ $phone }}">
    <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_signature" id="razorpay_signature">
  </form>

  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <script>
    (function(){
      const btn = document.getElementById('payNowBtn');
      const orderId = @json((string) ($booking->gateway_order_id ?? ''));
      const amountPaise = Math.round(parseFloat(@json((string) ($booking->amount_paid ?? 0))) * 100);
      const keyId = @json((string) $razorpay_key_id);
      const bookingCode = @json((string) ($booking->booking_code ?: $booking->id));

      btn.addEventListener('click', function(){
        if(!keyId || !orderId){
          alert('Payment is not configured correctly. Please try again later.');
          return;
        }

        const options = {
          key: keyId,
          amount: amountPaise,
          currency: "INR",
          name: "Om Shanti Travels",
          description: "Advance payment for booking " + bookingCode,
          order_id: orderId,
          prefill: {
            name: @json((string) ($booking->name ?? '')),
            contact: @json((string) ($booking->phone ?? '')),
            email: @json((string) ($booking->email ?? '')),
          },
          notes: {
            booking_id: @json((string) $booking->id),
            booking_code: @json((string) ($booking->booking_code ?? '')),
          },
          method: {
            upi: true,
            card: true,
            netbanking: true,
            wallet: true,
            emi: true,
            paylater: true
          },
          theme: { color: "#2563eb" },
          handler: function (response){
            document.getElementById('razorpay_order_id').value = response.razorpay_order_id || '';
            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id || '';
            document.getElementById('razorpay_signature').value = response.razorpay_signature || '';
            document.getElementById('verifyForm').submit();
          }
        };

        const rzp = new Razorpay(options);
        rzp.open();
      });
    })();
  </script>
</body>
</html>
