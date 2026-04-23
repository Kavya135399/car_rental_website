<!DOCTYPE html>
<html>
<head>
    <title>Manage Content</title>
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
        .tabs{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:16px;}
        .tab{padding:10px 12px;border-radius:10px;border:1px solid #1e293b;color:#cbd5f5;text-decoration:none;}
        .tab.active{background:#1e293b;color:white;}
        table{width:100%;border-collapse:collapse;margin-top:14px;}
        th,td{padding:12px;text-align:left;border-bottom:1px solid #1e293b;}
        th{background:#0b1324;}
        .btn{padding:10px 12px;border-radius:10px;text-decoration:none;font-weight:700;display:inline-block;}
        .btn-add{background:#22c55e;color:#0f172a;}
        .btn-edit{background:#3b82f6;color:white;}
        .btn-del{background:#ef4444;color:white;}
        .muted{color:#94a3b8;}

        @media (max-width: 768px){
            body{flex-direction:column;}
            .sidebar{position:relative;width:100%;height:auto;}
            .main{margin-left:0;padding:16px;}
            .card{padding:14px;overflow-x:auto;}
            table{display:block;overflow-x:auto;-webkit-overflow-scrolling:touch;min-width:720px;}
            th,td{white-space:nowrap;}
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
        <a href="/admin/content">Content</a>
        <a href="/admin/logout">Logout</a>
    </div>

    <div class="main">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;">
            <div>
                <h1 style="font-weight:500;">Content Manager</h1>
                <div class="muted" style="margin-top:6px;">This powers the `/premium` site sections.</div>
            </div>
            <a class="btn btn-add" href="/admin/content/create?type={{ $type }}">+ Add</a>
        </div>

        <div class="tabs">
            @foreach($types as $t)
                <a class="tab {{ $type === $t ? 'active' : '' }}" href="/admin/content?type={{ $t }}">{{ ucfirst($t) }}</a>
            @endforeach
        </div>

        @if(session('success'))
            <div class="card" style="border:1px solid rgba(34,197,94,.35);background:rgba(34,197,94,.12);margin-bottom:14px;">
                <span style="color:#bbf7d0;">{{ session('success') }}</span>
            </div>
        @endif

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Order</th>
                        <th>Published</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $i)
                        <tr>
                            <td>{{ $i->title ?? '—' }}</td>
                            <td class="muted">{{ $i->subtitle ?? '—' }}</td>
                            <td>{{ $i->sort_order }}</td>
                            <td>{{ $i->is_published ? 'Yes' : 'No' }}</td>
                            <td>
                                <a class="btn btn-edit" href="/admin/content/edit/{{ $i->id }}">Edit</a>
                                <a class="btn btn-del" href="/admin/content/delete/{{ $i->id }}" onclick="return confirm('Delete this content item?')">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    @if($items->count() === 0)
                        <tr><td colspan="5" class="muted">No items yet.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
