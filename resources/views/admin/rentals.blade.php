<!-- <!DOCTYPE html>
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
                                        <input name="admin_utr" placeholder="Enter 12-digit UTR from statement" inputmode="numeric" pattern="[0-9]{12}" required>
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
</html> -->


<!DOCTYPE html>
<html>
<head>
    <title>Bookings - Om Shanti Travels</title>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <style>
:root {
    --bg-dark: #0f172a;
    --card-bg: rgba(30, 41, 59, 0.7);
    --border: rgba(255, 255, 255, 0.1);
    --accent: #38bdf8;
    --text-white: #f8fafc;
    --text-muted: #94a3b8;
    --input-bg: rgba(15, 23, 42, 0.6);
}

*{margin:0;padding:0;box-sizing:border-box;font-family:'Rajdhani',sans-serif;}
body{display:flex;background:var(--bg-dark);color:var(--text-white);overflow-x:auto;min-height:100vh;}

/* --- 3D BACKGROUND --- */
#bg-canvas{position:fixed;top:0;left:0;width:100%;height:100%;z-index:-1;opacity:.4;pointer-events:none;}

/* --- SIDEBAR --- */
.sidebar{width:260px;min-width:260px;height:100vh;background:rgba(15,23,42,.95);backdrop-filter:blur(10px);border-right:1px solid var(--border);padding:30px 20px;position:fixed;z-index:100;display:flex;flex-direction:column;overflow-y:auto;}
.sidebar h2{font-size:28px;font-weight:700;color:white;margin-bottom:50px;text-transform:uppercase;letter-spacing:2px;text-shadow:0 0 10px var(--accent);}
.sidebar a{display:flex;align-items:center;padding:15px;color:#cbd5e1;text-decoration:none;border-radius:10px;margin-bottom:10px;transition:.3s;font-size:18px;font-weight:600;white-space:nowrap;}
.sidebar a::before{font-family:'Font Awesome 6 Free';font-weight:900;margin-right:15px;color:var(--accent);width:20px;text-align:center;flex-shrink:0;}
.sidebar a[href*="dashboard"]::before{content:'\f00a';}
.sidebar a[href*="cars"]::before{content:'\f1b9';}
.sidebar a[href*="rentals"]::before{content:'\f073';}
.sidebar a[href*="drivers"]::before{content:'\f084';}
.sidebar a[href*="bookings"]::before{content:'\f0c0';}
.sidebar a[href*="logout"]::before{content:'\f2f5';color:#ef4444;}
.sidebar a:hover,.sidebar a.active{background:rgba(56,189,248,.1);color:white;transform:translateX(10px);border-left:4px solid var(--accent);}

/* --- MAIN --- */
.main{margin-left:260px;width:calc(100% - 260px);min-width:900px;padding:40px;}

/* --- HEADER --- */
.main>h1{font-size:32px;font-weight:700;background:linear-gradient(to right,#fff,#94a3b8);-webkit-background-clip:text;-webkit-text-fill-color:transparent;text-transform:uppercase;letter-spacing:1px;animation:slideDown .6s ease;}

@keyframes slideDown{from{opacity:0;transform:translateY(-20px);}to{opacity:1;transform:translateY(0);}}
@keyframes fadeIn{from{opacity:0;transform:translateY(15px);}to{opacity:1;transform:translateY(0);}}

/* --- CARDS --- */
.card{background:var(--card-bg);border:1px solid var(--border);border-radius:16px;padding:24px;backdrop-filter:blur(12px);box-shadow:0 20px 40px rgba(0,0,0,.3);animation:fadeIn .8s ease forwards;margin-top:14px;overflow-x:auto;}

/* --- ALERT CARDS --- */
.card[style*="251,191,36"]{border-color:rgba(251,191,36,.3)!important;background:rgba(251,191,36,.08)!important;border-radius:12px;backdrop-filter:blur(8px);}
.card[style*="34,197,94"]{border-color:rgba(34,197,94,.3)!important;background:rgba(34,197,94,.08)!important;border-radius:12px;backdrop-filter:blur(8px);}
.card[style*="251,113,133"]{border-color:rgba(251,113,133,.3)!important;background:rgba(251,113,133,.08)!important;border-radius:12px;backdrop-filter:blur(8px);}

/* --- TABLE --- */
table{width:100%;border-collapse:separate;border-spacing:0;margin-top:16px;min-width:960px;}
thead tr{background:rgba(15,23,42,.6);}
th{padding:14px 16px;text-align:left;color:var(--text-muted);font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:.8px;border-bottom:1px solid var(--border);white-space:nowrap;}
th:first-child{border-radius:10px 0 0 0;}
th:last-child{border-radius:0 10px 0 0;}
td{padding:16px;border-bottom:1px solid rgba(255,255,255,.05);vertical-align:top;font-size:15px;line-height:1.5;}
tbody tr{transition:background .2s;}
tbody tr:hover{background:rgba(56,189,248,.04);}

/* --- PILLS --- */
.pill{display:inline-block;padding:5px 14px;border-radius:999px;font-size:12px;font-weight:700;letter-spacing:.3px;border:1px solid rgba(255,255,255,.08);background:rgba(255,255,255,.06);transition:.2s;white-space:nowrap;}
.pill.ok{color:#bbf7d0;background:rgba(34,197,94,.12);border-color:rgba(34,197,94,.25);}
.pill.warn{color:#fde68a;background:rgba(251,191,36,.12);border-color:rgba(251,191,36,.25);}
.pill.bad{color:#fecaca;background:rgba(251,113,133,.12);border-color:rgba(251,113,133,.25);}

/* --- INPUTS / SELECTS / BUTTONS --- */
input[type="text"],input[type="number"],input:not([type]){padding:11px 14px;border-radius:8px;border:1px solid var(--border);background:var(--input-bg);color:white;font-size:14px;font-family:'Rajdhani',sans-serif;font-weight:600;transition:all .3s;min-width:0;width:100%;}
input:focus{outline:none;border-color:var(--accent);background:rgba(15,23,42,.8);box-shadow:0 0 0 3px rgba(56,189,248,.1);}
select{padding:11px 14px;border-radius:8px;border:1px solid var(--border);background:var(--input-bg);color:white;font-size:14px;font-family:'Rajdhani',sans-serif;font-weight:600;transition:all .3s;cursor:pointer;min-width:0;}
select:focus{outline:none;border-color:var(--accent);box-shadow:0 0 0 3px rgba(56,189,248,.1);}
select option{background:#0f172a;color:white;}

button{padding:11px 18px;border:none;border-radius:8px;font-size:14px;font-weight:700;font-family:'Rajdhani',sans-serif;text-transform:uppercase;letter-spacing:.5px;cursor:pointer;transition:all .3s;white-space:nowrap;flex-shrink:0;}
button:hover{transform:translateY(-1px);filter:brightness(1.08);}

/* Button color variants */
button[style*="fbbf24"]{box-shadow:0 4px 15px rgba(251,191,36,.25);color:#0f172a;}
button[style*="22c55e"]{box-shadow:0 4px 15px rgba(34,197,94,.25);color:#0f172a;}
button[style*="ef4444"]{box-shadow:0 4px 15px rgba(239,68,68,.25);color:white;}
button[style*="3b82f6"]{box-shadow:0 4px 15px rgba(59,130,246,.25);color:white;}
button[style*="a855f7"]{box-shadow:0 4px 15px rgba(168,85,247,.25);color:white;}

/* --- INLINE TEXT STYLES --- */
div[style*="font-weight:700"]{color:white;}
div[style*="color:#94a3b8"],div[style*="color:#cbd5f5"]{font-weight:500;}
div[style*="color:#64748b"]{font-weight:500;}

/* --- FORM ROWS inside table --- */
form[style*="display:flex"]{display:flex!important;gap:8px!important;align-items:center!important;flex-wrap:nowrap!important;}
form[style*="display:flex"] input{flex:1!important;min-width:160px!important;}
form[style*="display:flex"] select{flex:1!important;min-width:140px!important;}

/* --- SCROLLBAR --- */
::-webkit-scrollbar{width:6px;height:6px;}
::-webkit-scrollbar-track{background:transparent;}
::-webkit-scrollbar-thumb{background:rgba(255,255,255,.1);border-radius:10px;}
::-webkit-scrollbar-thumb:hover{background:rgba(255,255,255,.2);}

/* --- RESPONSIVE --- */
@media(max-width:900px){
    .sidebar{width:80px;min-width:80px;padding:30px 10px;}
    .sidebar h2,.sidebar a span{display:none;}
    .sidebar h2{font-size:24px;text-align:center;}
    .sidebar a{justify-content:center;padding:15px 0;}
    .sidebar a::before{margin-right:0;font-size:20px;}
    .sidebar a.active{border-left:none;border-right:4px solid var(--accent);}
    .main{margin-left:80px;width:calc(100% - 80px);min-width:700px;padding:20px;}
    .main>h1{font-size:24px;}
}

@media(max-width:768px){
    body{flex-direction:column;overflow-x:auto;}
    .sidebar{position:relative;width:100%;min-width:100%;height:auto;display:flex;flex-direction:row;flex-wrap:wrap;justify-content:center;padding:15px 10px;border-right:none;border-bottom:1px solid var(--border);}
    .sidebar h2{display:none;}
    .sidebar a{padding:10px 14px;margin:0 4px;font-size:14px;}
    .sidebar a::before{margin-right:6px;font-size:14px;}
    .sidebar a:hover,.sidebar a.active{transform:translateY(-2px);border-left:none;border-right:none;border-bottom:3px solid var(--accent);}
    .main{margin-left:0;width:auto;min-width:900px;padding:16px;}
    .card{padding:14px;}
    table{display:block;overflow-x:auto;-webkit-overflow-scrolling:touch;min-width:960px;}
    th,td{white-space:nowrap;}
}
    </style>
</head>
<body>

<canvas id="bg-canvas"></canvas>

    <div class="sidebar">
<h2>🚗 Admin</h2>
<a href="/admin/dashboard">Dashboard</a>
<a href="/admin/cars">Manage Cars</a>
<a href="/admin/rentals" class="active">Bookings</a>
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
                                        <input name="admin_utr" placeholder="Enter 12-digit UTR from statement" inputmode="numeric" pattern="[0-9]{12}" required>
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

<script>
const initBg=()=>{const c=document.getElementById('bg-canvas');if(!c)return;const s=new THREE.Scene(),cam=new THREE.PerspectiveCamera(75,innerWidth/innerHeight,.1,1e3),r=new THREE.WebGLRenderer({canvas:c,alpha:true});r.setSize(innerWidth,innerHeight);const g=new THREE.IcosahedronGeometry(15,1),m=new THREE.MeshBasicMaterial({color:0x38bdf8,wireframe:true,transparent:true,opacity:.05}),sh=new THREE.Mesh(g,m);s.add(sh);const pg=new THREE.BufferGeometry(),pc=200,pa=new Float32Array(pc*3);for(let i=0;i<pc*3;i++)pa[i]=(Math.random()-.5)*50;pg.setAttribute('position',new THREE.BufferAttribute(pa,3));const pt=new THREE.Points(pg,new THREE.PointsMaterial({size:.05,color:0xffffff,transparent:true,opacity:.5}));s.add(pt);cam.position.z=25;(function a(){requestAnimationFrame(a);sh.rotation.x+=.001;sh.rotation.y+=.001;pt.rotation.y-=.0005;r.render(s,cam)})();addEventListener('resize',()=>{cam.aspect=innerWidth/innerHeight;cam.updateProjectionMatrix();r.setSize(innerWidth,innerHeight)})};
window.onload=initBg;
</script>
</body>
</html>