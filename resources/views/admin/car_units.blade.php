<!DOCTYPE html>
<html>
<head>
    <title>Car Units - Om Shanti Travels</title>
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
        .row{display:flex;gap:16px;flex-wrap:wrap;}
        input,select{width:100%;padding:12px;border-radius:8px;border:1px solid #1e293b;background:#0f172a;color:white;outline:none;}
        button{padding:12px 14px;border:none;border-radius:10px;background:#f59e0b;color:#0f172a;font-weight:700;cursor:pointer;}
        button:hover{filter:brightness(1.04);}
        table{width:100%;border-collapse:collapse;margin-top:14px;}
        th,td{padding:12px;text-align:left;border-bottom:1px solid #1e293b;}
        th{background:#0b1324;}
        .pill{display:inline-block;padding:6px 10px;border-radius:999px;background:rgba(255,255,255,.10);border:1px solid rgba(255,255,255,.12);font-size:12px;}
        .ok{color:#bbf7d0;}
        .warn{color:#fde68a;}
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
        <h1 style="font-weight:500;margin-bottom:10px;">Car Units</h1>
        <p style="color:#94a3b8;margin-bottom:18px;">
            {{ $car->brand }} · <strong style="color:white;">{{ $car->name }}</strong>
            · <a class="link" href="/admin/cars">Back to cars</a>
        </p>

        @if(isset($schemaReady) && $schemaReady === false)
            <div class="card" style="border:1px solid rgba(251,191,36,.35);background:rgba(251,191,36,.10);margin-bottom:14px;">
                <span style="color:#fde68a;">Stock module is not ready. Run `php artisan migrate` to create the `car_units` table.</span>
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

        <div class="row" @if(isset($schemaReady) && $schemaReady === false) style="opacity:.6;pointer-events:none;" @endif>
            <div class="card" style="flex:1;min-width:280px;">
                <h3 style="margin-bottom:10px;font-weight:600;">Add Unit</h3>
                <form method="POST" action="/admin/cars/{{ $car->id }}/units">
                    @csrf
                    <label style="font-size:12px;color:#94a3b8;">Number Plate (optional)</label>
                    <input name="number_plate" placeholder="e.g. MH12AB1234">
                    <div style="height:10px;"></div>
                    <label style="font-size:12px;color:#94a3b8;">Status</label>
                    <select name="status">
                        <option value="active">Active</option>
                        <option value="maintenance">Maintenance</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    <div style="height:12px;"></div>
                    <button type="submit">Add</button>
                </form>
            </div>

            <div class="card" style="flex:1;min-width:280px;">
                <h3 style="margin-bottom:10px;font-weight:600;">Bulk Add</h3>
                <form method="POST" action="/admin/cars/{{ $car->id }}/units/bulk">
                    @csrf
                    <label style="font-size:12px;color:#94a3b8;">Count</label>
                    <input name="count" type="number" min="1" max="200" value="1">
                    <div style="height:12px;"></div>
                    <button type="submit">Create Empty Units</button>
                    <p style="margin-top:10px;color:#94a3b8;font-size:12px;">Tip: add number plates later. Units without plates can still reserve stock; email will show plate only if filled.</p>
                </form>
            </div>
        </div>

        <div class="card" style="margin-top:16px;">
            <h3 style="font-weight:600;">Existing Units ({{ $units->count() }})</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Number Plate</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($units as $u)
                    <tr>
                        <td>{{ $u->id }}</td>
                        <td>{{ $u->number_plate ?: '—' }}</td>
                        <td>
                            @if($u->status === 'active')
                                <span class="pill ok">Active</span>
                            @elseif($u->status === 'maintenance')
                                <span class="pill warn">Maintenance</span>
                            @else
                                <span class="pill bad">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a class="link" href="/admin/cars/{{ $car->id }}/units/delete/{{ $u->id }}" onclick="return confirm('Delete this unit?')">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
