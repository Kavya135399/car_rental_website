<!DOCTYPE html>
<html lang="en">
<head>
  <title>Receipt - Om Shanti Travels</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <style>
    :root{--border:#e5e7eb;--muted:#6b7280;--ink:#111827;--bg:#f3f4f6;}
    body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;background:var(--bg);color:var(--ink);margin:0;}
    .wrap{max-width:900px;margin:22px auto;padding:0 14px;}
    .card{background:#fff;border:1px solid var(--border);border-radius:14px;box-shadow:0 10px 25px rgba(0,0,0,0.06);}
    .head{display:flex;gap:12px;flex-wrap:wrap;align-items:flex-start;justify-content:space-between;padding:18px 18px 0 18px;}
    .title{font-size:18px;font-weight:800;margin:0;}
    .muted{color:var(--muted);font-size:12.5px;}
    .btns{display:flex;gap:10px;flex-wrap:wrap;}
    .btn{display:inline-block;padding:10px 12px;border-radius:12px;border:1px solid var(--border);text-decoration:none;color:var(--ink);background:#fff;font-weight:700;font-size:13px;}
    .btn.primary{background:#2563eb;border-color:#2563eb;color:#fff;}
    .body{padding:18px;}
    .grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
    .box{border:1px solid var(--border);border-radius:12px;padding:12px;background:#fff;}
    .kv{display:flex;justify-content:space-between;gap:10px;margin-top:8px;}
    .kv div:first-child{color:var(--muted);font-size:12.5px;}
    .kv div:last-child{font-weight:700;}
    table{width:100%;border-collapse:collapse;margin-top:12px;}
    th,td{border:1px solid var(--border);padding:10px 10px;text-align:left;font-size:13px;}
    th{background:#f8fafc;font-size:12px;color:#374151;letter-spacing:.02em;text-transform:uppercase;}
    .right{text-align:right;}
    .foot{padding:0 18px 18px 18px;}
    .pill{display:inline-block;padding:6px 10px;border-radius:999px;font-size:12px;border:1px solid rgba(0,0,0,0.08);background:#f8fafc;}
    .ok{background:rgba(34,197,94,.12);color:#166534;border-color:rgba(34,197,94,.25);}
    .warn{background:rgba(245,158,11,.12);color:#92400e;border-color:rgba(245,158,11,.25);}
    @media (max-width:720px){.grid{grid-template-columns:1fr;}}
    @media print{
      body{background:#fff;}
      .wrap{margin:0;max-width:none;padding:0;}
      .card{border:none;box-shadow:none;border-radius:0;}
      .btns{display:none !important;}
      a{color:inherit;text-decoration:none;}
    }
  </style>
</head>
<body>
  @php
    $company = 'Om Shanti Travels';
    $bookingCode = $booking->booking_code ?: ('#' . $booking->id);
    $receiptNo = $booking->receipt_number ?? null;
    $generatedAt = $booking->receipt_generated_at ?? now();
    $total = (float) ($booking->total_amount ?? 0);
    $paid = (float) ($booking->amount_paid ?? 0);
    $balance = max($total - $paid, 0);
    $pm = (string) ($booking->payment_method ?? '');
    $ps = (string) ($payment_status ?? ($booking->payment_status ?? ''));
    $isProvisional = (bool) ($is_provisional ?? false);
    $utr = (string) ($booking->payment_utr ?? '');
    $utrMasked = $utr ? (strlen($utr) <= 6 ? $utr : (substr($utr, 0, 2) . str_repeat('•', max(strlen($utr) - 4, 0)) . substr($utr, -2))) : '—';
    $pill = 'warn';
    if ($ps === 'Paid' || $ps === 'Cash') $pill = 'ok';
  @endphp

  <div class="wrap">
    <div class="card">
      <div class="head">
        <div>
          <h1 class="title">Payment Receipt</h1>
          <div class="muted" style="margin-top:4px;">
            Receipt: <strong>{{ $receiptNo ?: '—' }}</strong> &nbsp;|&nbsp;
            Booking: <strong>{{ $bookingCode }}</strong> &nbsp;|&nbsp;
            Date: <strong>{{ \Carbon\Carbon::parse($generatedAt)->format('d M Y, H:i') }}</strong>
          </div>
          @if($isProvisional)
            <div class="muted" style="margin-top:8px;">
              <span class="pill warn">Provisional</span>
              This bill is generated based on the UTR you submitted and is pending verification.
            </div>
          @endif
        </div>
        <div class="btns">
          <a class="btn" href="{{ url('/booking/status?code=' . urlencode($code) . '&phone=' . urlencode($phone)) }}">Back to Status</a>
          <a class="btn" href="{{ url('/booking/receipt?download=1&code=' . urlencode($code) . '&phone=' . urlencode($phone)) }}">Download</a>
          <a class="btn primary" href="#" onclick="window.print();return false;">Print / Save PDF</a>
        </div>
      </div>

      <div class="body">
        <div class="grid">
          <div class="box">
            <div style="font-weight:800;">{{ $company }}</div>
            <div class="muted" style="margin-top:6px;">Car rental booking receipt (payment acknowledgement).</div>
            <div class="muted" style="margin-top:10px;">
              Support: <strong>+91-XXXXXXXXXX</strong> &nbsp;|&nbsp; <strong>support@example.com</strong>
            </div>
          </div>
          <div class="box">
            <div style="font-weight:800;">Billed To</div>
            <div style="margin-top:6px;">{{ $booking->name }}</div>
            <div class="muted" style="margin-top:6px;">Phone: {{ $booking->phone }}</div>
            @if(!empty($booking->email))
              <div class="muted">Email: {{ $booking->email }}</div>
            @endif
          </div>
        </div>

        <table>
          <thead>
            <tr>
              <th>Description</th>
              <th class="right">Amount (INR)</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                Booking for {{ $booking->carModel?->name ?? $booking->car }}
                <div class="muted" style="margin-top:4px;">
                  Pickup: {{ $booking->pickup_location ?? $booking->pickup ?? '—' }} &nbsp;|&nbsp;
                  Drop: {{ $booking->dropoff_location ?? $booking->drop ?? '—' }}
                </div>
              </td>
              <td class="right">{{ number_format($total, 2) }}</td>
            </tr>
            <tr>
              <td><strong>Amount Paid</strong></td>
              <td class="right"><strong>{{ number_format($paid, 2) }}</strong></td>
            </tr>
            <tr>
              <td><strong>Balance Due</strong></td>
              <td class="right"><strong>{{ number_format($balance, 2) }}</strong></td>
            </tr>
          </tbody>
        </table>

        <div class="grid" style="margin-top:12px;">
          <div class="box">
            <div style="font-weight:800;">Payment Details</div>
            <div class="kv"><div>Method</div><div>{{ $pm ?: '—' }}</div></div>
            <div class="kv"><div>Status</div><div><span class="pill {{ $pill }}">{{ $ps ?: '—' }}</span></div></div>
            @if($pm === 'UPI' || $pm === 'Online')
              <div class="kv"><div>UTR</div><div style="font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace;">{{ $utrMasked }}</div></div>
            @endif
            @if(!empty($booking->gateway_payment_id))
              <div class="kv"><div>Payment ID</div><div style="font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace;">{{ $booking->gateway_payment_id }}</div></div>
            @endif
            @if(!empty($booking->refund_status) || !empty($booking->refund_id))
              <div class="kv"><div>Refund</div><div>{{ $booking->refund_status ?: '—' }}</div></div>
              @if(!empty($booking->refund_id))
                <div class="kv"><div>Refund ID</div><div style="font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace;">{{ $booking->refund_id }}</div></div>
              @endif
              @if(!empty($booking->refund_amount))
                <div class="kv"><div>Refund Amount</div><div>{{ number_format((float) $booking->refund_amount, 2) }}</div></div>
              @endif
            @endif
          </div>
          <div class="box">
            <div style="font-weight:800;">Notes</div>
            <ul style="margin:10px 0 0 18px;color:var(--muted);font-size:13px;">
              <li>This receipt acknowledges payment received and may not be a GST/tax invoice unless explicitly stated.</li>
              <li>Keep your Booking ID and phone number to re-download this receipt anytime.</li>
              <li>Online payment terms: <a href="{{ url('/terms/online-payment') }}">{{ url('/terms/online-payment') }}</a></li>
            </ul>
          </div>
        </div>
      </div>

      <div class="foot">
        <div class="muted">
          If there is any mismatch in amount/UTR, contact support with Booking ID <strong>{{ $bookingCode }}</strong>.
        </div>
      </div>
    </div>
  </div>
</body>
</html>
