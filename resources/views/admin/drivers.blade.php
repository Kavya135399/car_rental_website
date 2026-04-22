<!DOCTYPE html>
<html>
<head>
    <title>Drivers - Om Shanti Travels</title>
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
        input{width:100%;padding:12px;border-radius:8px;border:1px solid #1e293b;background:#0f172a;color:white;outline:none;}
        button{padding:12px 14px;border:none;border-radius:10px;background:#22c55e;color:#0f172a;font-weight:800;cursor:pointer;}
        button:hover{filter:brightness(1.04);}
        table{width:100%;border-collapse:collapse;margin-top:14px;}
        th,td{padding:12px;text-align:left;border-bottom:1px solid #1e293b;}
        th{background:#0b1324;}
        .pill{display:inline-block;padding:6px 10px;border-radius:999px;background:rgba(255,255,255,.10);border:1px solid rgba(255,255,255,.12);font-size:12px;}
        .ok{color:#bbf7d0;}
        .bad{color:#fecaca;}
        .link{color:#93c5fd;text-decoration:none;}
        .link:hover{text-decoration:underline;}
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>🚗 Admin</h2>
        <a href="/admin/dashboard">Dashboard</a>
        <a href="/admin/cars">Manage Cars</a>
        <a href="/admin/rentals">Bookings</a>
        <a href="/admin/drivers">Drivers</a>
        <a href="/admin/logout">Logout</a>
    </div>

    <div class="main">
        <h1 style="font-weight:500;margin-bottom:14px;">Drivers</h1>

        @if(isset($schemaReady) && $schemaReady === false)
            <div class="card" style="border:1px solid rgba(251,191,36,.35);background:rgba(251,191,36,.10);margin-bottom:14px;">
                <span style="color:#fde68a;">Drivers module is not ready. Run `php artisan migrate` to create the `drivers` table.</span>
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
            <h3 style="margin-bottom:10px;font-weight:600;">Add Driver</h3>
            <form method="POST" action="/admin/drivers">
                @csrf
                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;">
                    <input name="name" placeholder="Driver name" required>
                    <input name="mobile" placeholder="Mobile" required>
                    <input name="license_number" placeholder="License number" required>
                </div>
                <div style="margin-top:12px;">
                    <button type="submit">Add</button>
                </div>
            </form>
        </div>

        <div class="card" style="margin-top:16px;">
            <h3 style="font-weight:600;">Driver List ({{ $drivers->count() }})</h3>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>License</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($drivers as $d)
                    <tr>
                        <td>{{ $d->name }}</td>
                        <td>{{ $d->mobile }}</td>
                        <td>{{ $d->license_number }}</td>
                        <td>
                            @if($d->is_active)
                                <span class="pill ok">Available</span>
                            @else
                                <span class="pill bad">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a class="link" href="/admin/drivers/toggle/{{ $d->id }}">Toggle</a>
                            <span style="color:#334155;"> | </span>
                            <a class="link" href="/admin/drivers/delete/{{ $d->id }}" onclick="return confirm('Delete this driver?')">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
