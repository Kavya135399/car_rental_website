<!DOCTYPE html>
<html>
<head>
    <title>Bookings - Om Shanti Travels</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
        body{display:flex;background:#0f172a;color:white;}
        .sidebar{width:220px;height:100vh;background:#020617;padding:25px;position:fixed;}
        .sidebar h2{margin-bottom:40px;}
        .sidebar a{display:block;color:#cbd5f5;padding:12px;margin-bottom:10px;text-decoration:none;border-radius:6px;transition:0.3s;}
        .sidebar a:hover{background:#1e293b;}
        .main{margin-left:220px;width:100%;padding:40px;}
        .card{background:#020617;border-radius:12px;padding:18px;box-shadow:0 10px 25px rgba(0,0,0,0.5);}
        table{width:100%;border-collapse:collapse;margin-top:14px;}
        th,td{padding:12px;text-align:left;border-bottom:1px solid #1e293b;vertical-align:top;}
        th{background:#0b1324;}
        .pill{display:inline-block;padding:6px 10px;border-radius:999px;background:rgba(255,255,255,.10);border:1px solid rgba(255,255,255,.12);font-size:12px;}
        .ok{color:#bbf7d0;}
        .warn{color:#fde68a;}
        .bad{color:#fecaca;}
        input{padding:10px;border-radius:10px;border:1px solid #1e293b;background:#0f172a;color:white;outline:none;}
        select{padding:10px;border-radius:10px;border:1px solid #1e293b;background:#0f172a;color:white;outline:none;}
        button{padding:10px 12px;border:none;border-radius:10px;background:#fbbf24;color:#0f172a;font-weight:800;cursor:pointer;}
        button:hover{filter:brightness(1.04);}
        .link{color:#93c5fd;text-decoration:none;}
        .link:hover{text-decoration:underline;}

        @media (max-width: 768px){
            body{flex-direction:column;}
            .sidebar{position:relative;width:100%;height:auto;}
            .main{margin-left:0;padding:16px;}
            .card{padding:14px;overflow-x:auto;}
            table{display:block;overflow-x:auto;-webkit-overflow-scrolling:touch;min-width:720px;}
            th,td{white-space:nowrap;}
            form[style*="display:flex"]{flex-direction:column;align-items:stretch;}
            input,select,button{width:100%;}
        }
    </style>
</head>
<body>
    <div class="sidebar">
<h2>🚗 Admin</h2>
<a href="/admin/dashboard">Dashboard</a>
<a href="/admin/cars">Manage Cars</a>
<a href="/admin/rentals">Bookings</a>
<a href="/admin/drivers">Drivers</a>
<a href="/admin/bookings">Customers</a>
<a href="/admin/logout">Logout</a>
</div>
    <div class="main">
        <h1 style="font-weight:500;margin-bottom:14px;">Rental Bookings</h1>

        @if(isset($schemaReady) && $schemaReady === false)
            <div class="card" style="border:1px solid rgba(251,191,36,.35);background:rgba(251,191,36,.10);margin-bottom:14px;">
                <span style="color:#fde68a;">Bookings module is not ready. Run `php artisan migrate` to add the new booking columns (pickup/drop times, status, etc.).</span>
            </div>
        @endif

        @if(session('success'))
            <div class="card" style="border:1px solid rgba(34,197,94,.35);background:rgba(34,197,94,.12);margin-bottom:14px;">
                <span class="ok">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="card" style="border:1px solid rgba(251,113,133,.35);background:rgba(251,113,133,.10);margin-bottom:14px;">
                <span class="bad">{{ session('error') }}</span>
            </div>
        @endif

        <div class="card" @if(isset($schemaReady) && $schemaReady === false) style="opacity:.6;pointer-events:none;" @endif>
            <table>
                <thead>
                    <tr>
                        <th>Booking</th>
                        <th>Customer</th>
                        <th>Car</th>
                        <th>Schedule</th>
                        <th>Status</th>
                        <th>Payment</th>
                        <th>Driver</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($bookings as $b)
                    <tr>
                        <td>
                            <div style="font-weight:700;">{{ $b->booking_code ?: ('#' . $b->id) }}</div>
                            <div style="color:#94a3b8;font-size:12px;">₹{{ number_format($b->total_amount ?? 0) }}</div>
                        </td>
                        <td>
                            <div style="font-weight:700;">{{ $b->name }}</div>
                            <div style="color:#94a3b8;font-size:12px;">{{ $b->phone }}</div>
                            <div style="color:#94a3b8;font-size:12px;">{{ $b->email ?: '—' }}</div>
                        </td>
                        <td>
                            <div style="font-weight:700;">{{ $b->carModel?->name ?? $b->car }}</div>
                            <div style="color:#94a3b8;font-size:12px;">Unit: {{ $b->unit?->number_plate ?: ($b->car_unit_id ? ('ID ' . $b->car_unit_id) : '—') }}</div>
                        </td>
                        <td style="min-width:220px;">
                            <div style="font-size:12px;color:#cbd5f5;">
                                {{ $b->pickup_at ? $b->pickup_at->format('d M Y, H:i') : '—' }}
                                <span style="color:#64748b;">→</span>
                                {{ $b->dropoff_at ? $b->dropoff_at->format('d M Y, H:i') : '—' }}
                            </div>
                            <div style="font-size:12px;color:#94a3b8;">
                                {{ $b->pickup_location ?: 'Pickup: —' }} · {{ $b->dropoff_location ?: 'Drop: —' }}
                            </div>
                        </td>
                        <td>
                            @php $st = $b->status ?: 'Pending'; @endphp
                            @if($st === 'Confirmed' || $st === 'Completed')
                                <span class="pill ok">{{ $st }}</span>
                            @elseif($st === 'In Use')
                                <span class="pill warn">{{ $st }}</span>
                            @elseif($st === 'Cancelled')
                                <span class="pill bad">{{ $st }}</span>
                            @else
                                <span class="pill">{{ $st }}</span>
                            @endif
                        </td>
                        <td style="min-width:260px;">
                            @php
                                $pm = $b->payment_method ?: '—';
                                $gw = $b->payment_gateway ?: '';
                                $ps = $b->payment_status ?: (($pm === 'Cash') ? 'Cash' : 'Unpaid');
                                $utr = $b->payment_utr ?: '';
                                $pid = $b->gateway_payment_id ?: '';
                                $rid = $b->refund_id ?: '';
                            @endphp

                            <div style="font-weight:700;">{{ $pm }}</div>

                            @if($ps === 'Paid' || $ps === 'Cash')
                                <span class="pill ok">{{ $ps }}</span>
                            @elseif($ps === 'Rejected')
                                <span class="pill bad">{{ $ps }}</span>
                            @else
                                <span class="pill warn">{{ $ps }}</span>
                            @endif

                            @if($pm === 'Online')
                                <div style="margin-top:8px;font-size:12px;color:#cbd5f5;">
                                    Gateway: <span style="font-weight:700;">{{ $gw !== '' ? $gw : '—' }}</span>
                                </div>
                                <div style="margin-top:6px;font-size:12px;color:#cbd5f5;">
                                    Payment ID: <span style="font-weight:700;">{{ $pid !== '' ? $pid : '—' }}</span>
                                </div>
                                @if($rid !== '')
                                    <div style="margin-top:6px;font-size:12px;color:#cbd5f5;">
                                        Refund ID: <span style="font-weight:700;">{{ $rid }}</span>
                                    </div>
                                @endif
                            @endif

                            @if($pm === 'UPI')
                                <div style="margin-top:8px;font-size:12px;color:#cbd5f5;">
                                    UTR: <span style="font-weight:700;">{{ $utr !== '' ? $utr : '—' }}</span>
                                </div>

                                @if($ps !== 'Paid' && $utr !== '')
                                    <form method="POST" action="/admin/rentals/{{ $b->id }}/payment/verify" style="display:flex;gap:10px;align-items:center;margin-top:10px;">
                                        @csrf
                                        <input name="admin_utr" placeholder="Enter UTR from statement" required>
                                        <button type="submit" style="background:#22c55e;color:#0f172a;">Verify</button>
                                    </form>

                                    <form method="POST" action="/admin/rentals/{{ $b->id }}/payment/reject" style="display:flex;gap:10px;align-items:center;margin-top:10px;">
                                        @csrf
                                        <button type="submit" style="background:#ef4444;color:white;">Reject</button>
                                    </form>
                                @elseif($ps === 'Paid' && $b->payment_verified_at)
                                    <div style="margin-top:8px;font-size:12px;color:#94a3b8;">
                                        Verified: {{ $b->payment_verified_at->format('d M Y, H:i') }}
                                    </div>
                                @endif
                            @endif
                        </td>
                        <td>
                            <div style="font-weight:700;">{{ $b->driver?->name ?: '—' }}</div>
                            <div style="color:#94a3b8;font-size:12px;">{{ $b->driver?->mobile ?: '' }}</div>
                        </td>
                        <td style="min-width:260px;">
                            <form method="POST" action="/admin/rentals/{{ $b->id }}/confirm" style="display:flex;gap:10px;align-items:center;margin-bottom:10px;">
                                @csrf
                                <select name="driver_id" required>
                                    <option value="">Select driver</option>
                                    @foreach($drivers as $d)
                                        <option value="{{ $d->id }}" @selected($b->driver_id == $d->id)>{{ $d->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit">Confirm</button>
                            </form>

                            <form method="POST" action="/admin/rentals/{{ $b->id }}/status" style="display:flex;gap:10px;align-items:center;">
                                @csrf
                                <select name="status">
                                    @foreach(['Pending','Confirmed','In Use','Completed','Cancelled'] as $s)
                                        <option value="{{ $s }}" @selected(($b->status ?: 'Pending') === $s)>{{ $s }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" style="background:#3b82f6;color:white;">Update</button>
                            </form>

                            @if(($ps === 'Paid' || $ps === 'Cash') && $ps !== 'Refunded' && $ps !== 'Refund Initiated')
                                <form method="POST" action="/admin/rentals/{{ $b->id }}/payment/refund" style="display:flex;gap:10px;align-items:center;margin-top:10px;">
                                    @csrf
                                    <input name="refund_amount" placeholder="Refund amount (INR)" inputmode="decimal">
                                    <button type="submit" style="background:#a855f7;color:white;">Refund</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
