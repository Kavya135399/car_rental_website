<!-- <!DOCTYPE html>
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
<a href="/admin/bookings">Customers</a>
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
</html> -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Drivers - Om Shanti Travels</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Modern Tech Font -->
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- 3D Background Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

    <style>
        :root {
            --bg-dark: #0f172a;
            --card-bg: rgba(30, 41, 59, 0.7);
            --border: rgba(255, 255, 255, 0.1);
            --accent: #38bdf8; /* Light Blue */
            --text-white: #f8fafc;
            --text-muted: #94a3b8;
            --input-bg: rgba(15, 23, 42, 0.6);
            --success: #22c55e;
            --danger: #ef4444;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Rajdhani', sans-serif; }

        body {
            background-color: var(--bg-dark);
            color: var(--text-white);
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* --- 3D BACKGROUND --- */
        #bg-canvas {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            z-index: -1;
            opacity: 0.4;
            pointer-events: none;
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: 260px;
            height: 100vh;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
            border-right: 1px solid var(--border);
            position: fixed;
            padding: 30px 20px;
            z-index: 100;
            display: flex;
            flex-direction: column;
        }

        .sidebar h2 {
            font-size: 28px;
            font-weight: 700;
            color: white;
            margin-bottom: 50px;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 0 0 10px var(--accent);
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 15px;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 10px;
            transition: 0.3s;
            font-size: 18px;
            font-weight: 600;
        }

        /* CSS Icons for Sidebar */
        .sidebar a::before {
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            margin-right: 15px;
            color: var(--accent);
            width: 20px;
            text-align: center;
        }
        .sidebar a[href*="dashboard"]::before { content: '\f00a'; }
        .sidebar a[href*="cars"]::before { content: '\f1b9'; }
        .sidebar a[href*="rentals"]::before { content: '\f073'; }
        .sidebar a[href*="drivers"]::before { content: '\f084'; }
        .sidebar a[href*="bookings"]::before { content: '\f0c0'; }
        .sidebar a[href*="logout"]::before { content: '\f2f5'; color: #ef4444; }

        .sidebar a:hover, .sidebar a.active {
            background: rgba(56, 189, 248, 0.1);
            color: white;
            transform: translateX(10px);
            border-left: 4px solid var(--accent);
        }

        /* --- MAIN CONTENT --- */
        .main {
            margin-left: 260px;
            padding: 40px;
            width: calc(100% - 260px);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* --- HEADER --- */
        .page-header {
            width: 100%;
            max-width: 1000px; /* Slightly wider for table */
            margin-bottom: 30px;
            animation: slideDown 0.6s ease;
        }

        .page-header h1 {
            font-size: 32px;
            font-weight: 700;
            background: linear-gradient(to right, #fff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .page-header p {
            color: var(--text-muted);
            font-size: 16px;
        }

        @keyframes slideDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }

        /* --- CARD COMPONENT --- */
        .card {
            width: 100%;
            max-width: 1000px;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 30px;
            backdrop-filter: blur(12px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            margin-bottom: 20px;
            animation: fadeIn 0.8s ease forwards;
        }

        @keyframes fadeIn { to { opacity: 1; transform: translateY(0); } }

        .card h3 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* --- ALERTS --- */
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
            border: 1px solid transparent;
        }
        .alert-warning {
            background: rgba(251, 191, 36, 0.1);
            border-color: rgba(251, 191, 36, 0.3);
            color: #fcd34d;
        }
        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            border-color: rgba(34, 197, 94, 0.3);
            color: #86efac;
        }
        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border-color: rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }

        /* --- FORM STYLES --- */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 Columns for drivers inputs */
            gap: 20px;
        }

        .input-wrapper { position: relative; }

        .input-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            pointer-events: none;
            transition: 0.3s;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px 14px 46px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: var(--input-bg);
            color: white;
            font-size: 16px;
            transition: all 0.3s;
            outline: none;
        }

        .form-input:focus {
            border-color: var(--accent);
            background: rgba(15, 23, 42, 0.8);
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.1);
        }

        .form-input:focus + i { color: var(--accent); }

        .btn-submit {
            width: auto;
            min-width: 150px;
            padding: 14px 24px;
            background: linear-gradient(135deg, var(--accent), #0ea5e9);
            color: #0f172a;
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 20px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(56, 189, 248, 0.3);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(56, 189, 248, 0.5);
        }

        .disabled-card {
            opacity: 0.6;
            pointer-events: none;
            filter: grayscale(0.5);
        }

        /* --- TABLE STYLES --- */
        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            color: var(--text-white);
        }

        th {
            text-align: left;
            padding: 16px;
            border-bottom: 2px solid rgba(255,255,255,0.1);
            color: var(--accent);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 1px;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            color: #cbd5e1;
            vertical-align: middle;
        }

        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(255,255,255,0.02); }

        /* Status Pills */
        .pill {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .pill-active {
            background: rgba(34, 197, 94, 0.15);
            color: #86efac;
            border: 1px solid rgba(34, 197, 94, 0.3);
            box-shadow: 0 0 10px rgba(34, 197, 94, 0.1);
        }

        .pill-inactive {
            background: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        /* Action Links */
        .action-link {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: 0.2s;
            display: inline-block;
            margin-right: 10px;
        }

        .action-link:hover {
            color: white;
            text-shadow: 0 0 8px var(--accent);
        }

        .action-link.delete:hover {
            color: #ef4444;
            text-shadow: 0 0 8px #ef4444;
        }

        .separator {
            color: #475569;
            margin: 0 5px;
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 1024px) {
            .form-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 900px) {
            .sidebar { width: 80px; padding: 30px 10px; }
            .sidebar h2, .sidebar a span { display: none; }
            .sidebar h2 { font-size: 24px; text-align: center; }
            .sidebar a { justify-content: center; padding: 15px 0; }
            .sidebar a::before { margin-right: 0; font-size: 20px; }
            .sidebar a.active { border-left: none; border-right: 4px solid var(--accent); }
            .main { margin-left: 80px; width: calc(100% - 80px); padding: 20px; }
            .card { padding: 20px; }
            th, td { padding: 12px; }
        }
    </style>
</head>
<body>

<!-- 3D Background -->
<canvas id="bg-canvas"></canvas>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>🚗 Admin</h2>
    <a href="/admin/dashboard">Dashboard</a>
    <a href="/admin/cars">Manage Cars</a>
    <a href="/admin/rentals">Bookings</a>
    <!-- Drivers is active here -->
    <a href="/admin/drivers" class="active">Drivers</a>
    <a href="/admin/bookings">Customers</a>
    <a href="/admin/logout">Logout</a>
</div>

<!-- MAIN CONTENT -->
<div class="main">

    <div class="page-header">
        <h1>Drivers Management</h1>
        <p>Manage driver details, availability, and licenses.</p>
    </div>

    <!-- Schema Alert -->
    @if(isset($schemaReady) && $schemaReady === false)
        <div class="card alert-warning" style="margin-bottom:20px; padding-left: 20px;">
            <i class="fas fa-exclamation-triangle"></i>
            <span>Drivers module is not ready. Run <code>php artisan migrate</code> to create the <code>drivers</code> table.</span>
        </div>
    @endif

    <!-- Success Alert -->
    @if(session('success'))
        <div class="card alert-success" style="margin-bottom:20px; padding-left: 20px;">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Error Alert -->
    @if(session('error'))
        <div class="card alert-error" style="margin-bottom:20px; padding-left: 20px;">
            <i class="fas fa-times-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- ADD DRIVER CARD -->
    <div class="card @if(isset($schemaReady) && $schemaReady === false) disabled-card @endif">
        <h3><i class="fas fa-user-plus"></i> Add New Driver</h3>
        
        <form method="POST" action="/admin/drivers">
            @csrf
            <div class="form-grid">
                <!-- Driver Name -->
                <div class="input-wrapper">
                    <input name="name" class="form-input" placeholder="Driver Name" required>
                    <i class="fas fa-user"></i>
                </div>
                <!-- Mobile -->
                <div class="input-wrapper">
                    <input name="mobile" class="form-input" placeholder="Mobile Number" required>
                    <i class="fas fa-phone-alt"></i>
                </div>
                <!-- License -->
                <div class="input-wrapper">
                    <input name="license_number" class="form-input" placeholder="License Number" required>
                    <i class="fas fa-id-card"></i>
                </div>
            </div>
            
            <div>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-plus-circle"></i> Add Driver
                </button>
            </div>
        </form>
    </div>

    <!-- DRIVER LIST CARD -->
    <div class="card">
        <h3><i class="fas fa-list"></i> Driver List ({{ $drivers->count() }})</h3>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>License No.</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($drivers as $d)
                    <tr>
                        <td style="font-weight:600;">{{ $d->name }}</td>
                        <td>{{ $d->mobile }}</td>
                        <td><span style="font-family:monospace;">{{ $d->license_number }}</span></td>
                        <td>
                            @if($d->is_active)
                                <span class="pill pill-active"><i class="fas fa-check"></i> Available</span>
                            @else
                                <span class="pill pill-inactive"><i class="fas fa-ban"></i> Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a class="action-link" href="/admin/drivers/toggle/{{ $d->id }}">
                                <i class="fas fa-power-off"></i> Toggle
                            </a>
                            <span class="separator">|</span>
                            <a class="action-link delete" href="/admin/drivers/delete/{{ $d->id }}" onclick="return confirm('Delete this driver permanently?')">
                                <i class="fas fa-trash-alt"></i> Delete
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align:center; color: var(--text-muted); padding: 30px;">
                            No drivers found. Add one above.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- SCRIPTS (Background & Logic) -->
<script>
    /* 1. THREE.JS BACKGROUND */
    const initBg = () => {
        const canvas = document.getElementById('bg-canvas');
        if(!canvas) return;
        
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth/window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ canvas, alpha: true });
        renderer.setSize(window.innerWidth, window.innerHeight);
        
        // Main Wireframe Shape
        const geometry = new THREE.IcosahedronGeometry(15, 1);
        const material = new THREE.MeshBasicMaterial({ color: 0x38bdf8, wireframe: true, transparent: true, opacity: 0.05 });
        const shape = new THREE.Mesh(geometry, material);
        scene.add(shape);

        // Particles
        const partGeo = new THREE.BufferGeometry();
        const partCount = 200;
        const posArray = new Float32Array(partCount * 3);
        for(let i=0; i<partCount*3; i++) { posArray[i] = (Math.random() - 0.5) * 50; }
        partGeo.setAttribute('position', new THREE.BufferAttribute(posArray, 3));
        const particles = new THREE.Points(partGeo, new THREE.PointsMaterial({ size: 0.05, color: 0xffffff, transparent: true, opacity: 0.5 }));
        scene.add(particles);

        camera.position.z = 25;

        const animate = () => {
            requestAnimationFrame(animate);
            shape.rotation.x += 0.001; 
            shape.rotation.y += 0.001;
            particles.rotation.y -= 0.0005;
            renderer.render(scene, camera);
        };
        animate();

        window.addEventListener('resize', () => {
            camera.aspect = window.innerWidth/window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        });
    };

    window.onload = initBg;
</script>

</body>
</html>