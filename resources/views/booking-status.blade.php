<!DOCTYPE html>
<html lang="en">
<head>
  <title>Booking Status - Om Shanti Travels</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/open-iconic-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
  <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
  <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
  <link rel="stylesheet" href="{{ asset('css/icomoon.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <style>
    .status-card{background:#fff;border-radius:14px;box-shadow:0 10px 25px rgba(0,0,0,0.08);padding:22px;}
    .pill{display:inline-block;padding:6px 10px;border-radius:999px;font-size:12px;border:1px solid rgba(0,0,0,0.08);}
    .ok{background:rgba(34,197,94,.12);color:#166534;border-color:rgba(34,197,94,.25);}
    .warn{background:rgba(245,158,11,.12);color:#92400e;border-color:rgba(245,158,11,.25);}
    .bad{background:rgba(239,68,68,.10);color:#991b1b;border-color:rgba(239,68,68,.22);}
    .muted{color:#6b7280;font-size:13px;}
    .kv{display:flex;gap:10px;flex-wrap:wrap;margin-top:10px;}
    .kv > div{flex:1;min-width:220px;background:#f8fafc;border:1px solid #e5e7eb;border-radius:12px;padding:12px;}
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">Om Shanti<span> Travels</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="oi oi-menu"></span> Menu
    </button>

    <div class="collapse navbar-collapse" id="ftco-nav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="{{ url('/about') }}" class="nav-link">About</a></li>
        <li class="nav-item"><a href="{{ url('/cars') }}" class="nav-link">Cars</a></li>
        <li class="nav-item active"><a href="{{ url('/booking/status') }}" class="nav-link">Status</a></li>
        <li class="nav-item"><a href="{{ url('/blog') }}" class="nav-link">Blog</a></li>
        <li class="nav-item"><a href="{{ url('/contact') }}" class="nav-link">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>

<section class="ftco-section bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="status-card">
          <h3 style="margin:0 0 8px 0;">Booking & Payment Status</h3>
          <div class="muted">Enter your Booking ID and Phone number to check payment success.</div>

          @if(session('success'))
            <div style="margin-top:12px;" class="pill ok">{{ session('success') }}</div>
          @endif

          @if($errors->any())
            <div style="margin-top:12px;" class="pill bad">{{ $errors->first() }}</div>
          @endif

          <form method="POST" action="{{ url('/booking/status') }}" style="margin-top:16px;">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <label>Booking ID</label>
                <input class="form-control" id="code_input" name="code" value="{{ old('code', $code ?? '') }}" placeholder="BK-YYYYMMDD-XXXXXX or ID" required>
              </div>
              <div class="col-md-6">
                <label>Phone</label>
                <input class="form-control" id="phone_input" name="phone" value="{{ old('phone', $phone ?? '') }}" placeholder="10-digit phone (required for numeric ID)">
              </div>
              <div class="col-md-12" style="margin-top:14px;">
                <button type="submit" class="btn btn-primary" style="border-radius:12px;">Check Status</button>
                <button type="button" class="btn btn-outline-primary" id="downloadBillBtn" style="border-radius:12px;margin-left:8px;">Download Bill</button>
              </div>
            </div>
          </form>

          @if($booking)
            @php
              $pm = $booking->payment_method ?: '—';
              $ps = $booking->payment_status ?: (($pm === 'Cash') ? 'Cash' : 'Unpaid');
              $pillClass = 'warn';
              if ($ps === 'Paid' || $ps === 'Cash') $pillClass = 'ok';
              if ($ps === 'Rejected') $pillClass = 'bad';
              $paid = (float) ($booking->amount_paid ?? 0);
              $total = (float) ($booking->total_amount ?? 0);
              $balance = max($total - $paid, 0);
              $hasUtr = !empty($booking->payment_utr);
              $payId = $booking->gateway_payment_id ?? null;
              $canReceipt =
                in_array($ps, ['Paid', 'Cash', 'Refunded', 'Refund Initiated'], true);
            @endphp

            <div class="kv">
              <div>
                <div class="muted">Booking</div>
                <div style="font-weight:700;">{{ $booking->booking_code ?: ('#' . $booking->id) }}</div>
                <div class="muted" style="margin-top:6px;">Car: {{ $booking->carModel?->name ?? $booking->car }}</div>
              </div>
              <div>
                <div class="muted">Amount</div>
                <div style="font-weight:700;">₹{{ number_format($booking->total_amount ?? 0) }}</div>
                <div class="muted" style="margin-top:6px;">Paid: â‚¹{{ number_format($paid, 2) }} &nbsp;|&nbsp; Balance: â‚¹{{ number_format($balance, 2) }}</div>
                <div class="muted" style="margin-top:6px;">Booking Status: {{ $booking->status ?: 'Pending' }}</div>
              </div>
              <div>
                <div class="muted">Payment</div>
                <div style="font-weight:700;">{{ $pm }}</div>
                <div style="margin-top:6px;">
                  <span class="pill {{ $pillClass }}">{{ $ps }}</span>
                </div>
                @if($pm === 'UPI')
                  <div class="muted" style="margin-top:8px;">UTR: {{ $booking->payment_utr ?: '—' }}</div>
                @endif
                @if($pm === 'Online' && $payId)
                  <div class="muted" style="margin-top:8px;">Payment ID: {{ $payId }}</div>
                @endif
                @if(!empty($booking->refund_status) || in_array($ps, ['Refund Initiated', 'Refunded'], true))
                  <div class="muted" style="margin-top:8px;">
                    Refund: {{ $booking->refund_status ?: $ps }}
                    @if($booking->refunded_at)
                      ({{ $booking->refunded_at->format('d M Y, H:i') }})
                    @endif
                  </div>
                @endif
              </div>
            </div>

            @if($pm === 'Online' && $ps !== 'Paid' && $ps !== 'Rejected' && !empty($phone))
              <div style="margin-top:14px;display:flex;gap:10px;flex-wrap:wrap;">
                <a class="btn btn-primary" style="border-radius:12px;" href="{{ url('/payment/online?code=' . urlencode($code) . '&phone=' . urlencode($phone)) }}">Pay Online Now</a>
              </div>
              <div class="muted" style="margin-top:8px;">After payment, status will update automatically and bill will be available.</div>
            @elseif($pm === 'Online' && $ps !== 'Paid' && $ps !== 'Rejected' && empty($phone))
              <div style="margin-top:14px;" class="pill warn">Enter your phone number above to continue online payment.</div>
            @endif

            @if($canReceipt)
              <div style="margin-top:14px;display:flex;gap:10px;flex-wrap:wrap;">
                @php
                  $receiptBase = '/booking/receipt?code=' . urlencode($code);
                  $receiptBase .= !empty($phone) ? ('&phone=' . urlencode($phone)) : '';
                @endphp
                <a class="btn btn-primary" style="border-radius:12px;" href="{{ url($receiptBase) }}">View Bill</a>
                <a class="btn btn-outline-primary" style="border-radius:12px;" href="{{ url($receiptBase . '&download=1') }}">Download Bill</a>
              </div>
              @if($ps === 'Paid' || $ps === 'Cash')
                <div class="muted" style="margin-top:8px;">You can download this bill anytime using your Booking Code (BK-...) or Booking ID + phone.</div>
              @else
                <div class="muted" style="margin-top:8px;">This bill includes the latest refund/payment updates.</div>
              @endif
            @endif

            @if($pm === 'UPI' || $pm === 'Online')
              @if($ps === 'Paid')
                <div style="margin-top:14px;" class="pill ok">Payment succeeded ✅</div>
              @elseif($ps === 'Rejected')
                <div style="margin-top:14px;" class="pill bad">Payment failed / rejected. Please try again.</div>
                <div style="margin-top:12px;display:flex;gap:10px;flex-wrap:wrap;">
                  <a class="btn btn-primary" style="border-radius:12px;" href="{{ url('/booking') }}">Book Now</a>
                </div>
              @else
                <div style="margin-top:14px;" class="pill warn">Payment pending verification (admin will match your UTR in the UPI statement).</div>
                <div class="muted" style="margin-top:10px;">If you haven’t paid yet, scan and pay:</div>
                <div style="margin-top:10px;display:flex;gap:18px;flex-wrap:wrap;align-items:center;">
                  <div>
                    <img src="{{ asset('images/upi-qr1.jpeg') }}" alt="UPI QR" style="width:180px;border-radius:12px;border:1px solid #e5e7eb;">
                  </div>
                  <div>
                    <div style="font-weight:700;">UPI ID: davekavya43@oksbi</div>
                    <div class="muted" style="margin-top:6px;">After payment, submit the booking form with your UTR ID.</div>
                  </div>
                </div>
              @endif
            @endif
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script>
  (function(){
    const btn = document.getElementById('downloadBillBtn');
    if(!btn) return;
    btn.addEventListener('click', function(){
      const code = (document.getElementById('code_input')?.value || '').trim();
      const phone = (document.getElementById('phone_input')?.value || '').trim();
      if(!code){
        alert('Please enter your Booking ID / Booking Code.');
        return;
      }
      let url = '/booking/receipt?download=1&code=' + encodeURIComponent(code);
      if(phone){
        url += '&phone=' + encodeURIComponent(phone);
      }
      window.location.href = url;
    });
  })();
</script>
</body>
</html>
