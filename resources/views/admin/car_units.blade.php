<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Car Units - Om Shanti Travels</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- 3D Background Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

<style>
:root {
    --bg-dark: #0f172a;
    --sidebar-bg: rgba(15, 23, 42, 0.95);
    --card-bg: rgba(30, 41, 59, 0.7);
    --border: rgba(255, 255, 255, 0.1);
    --accent: #38bdf8; /* Light Blue */
    --input-bg: rgba(15, 23, 42, 0.6);
    --text-white: #f8fafc;
    --text-muted: #94a3b8;
    
    /* Status Colors */
    --success: #22c55e;
    --warning: #f59e0b;
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

/* --- SIDEBAR (Consistent with other pages) --- */
.sidebar {
    width: 260px;
    height: 100vh;
    background: var(--sidebar-bg);
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
}

/* --- HEADER --- */
.page-header {
    margin-bottom: 30px;
    animation: slideDown 0.6s ease;
}

.page-header h1 {
    font-size: 32px;
    font-weight: 700;
    color: white;
    text-transform: uppercase;
    margin-bottom: 5px;
}

.page-header p {
    color: var(--text-muted);
    font-size: 16px;
    margin-bottom: 20px;
}

.page-header .back-link {
    color: var(--accent);
    text-decoration: none;
    font-weight: 600;
    transition: 0.3s;
}
.page-header .back-link:hover { text-decoration: underline; }

@keyframes slideDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }

/* --- ALERTS --- */
.alert {
    padding: 16px;
    border-radius: 10px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    font-weight: 600;
    backdrop-filter: blur(5px);
}

.alert-success { background: rgba(34, 197, 94, 0.15); border: 1px solid rgba(34, 197, 94, 0.3); color: #bbf7d0; }
.alert-error { background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); color: #fecaca; }
.alert-warning { background: rgba(245, 158, 11, 0.15); border: 1px solid rgba(245, 158, 11, 0.3); color: #fde68a; }

/* --- CARDS (Form Area) --- */
.grid-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 30px;
}

.form-card {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 25px;
    backdrop-filter: blur(12px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

.form-card h3 {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 20px;
    color: white;
    border-bottom: 1px solid var(--border);
    padding-bottom: 10px;
    text-transform: uppercase;
}

.form-label {
    display: block;
    color: var(--text-muted);
    font-size: 14px;
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.input-wrapper {
    position: relative;
    margin-bottom: 15px;
}

.form-input {
    width: 100%;
    padding: 12px 16px;
    border-radius: 8px;
    border: 1px solid var(--border);
    background: var(--input-bg);
    color: white;
    font-size: 16px;
    transition: 0.3s;
}

.form-input:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.1);
}

.btn-add {
    width: 100%;
    padding: 12px;
    background: linear-gradient(135deg, var(--warning), #d97706);
    color: #0f172a;
    font-size: 16px;
    font-weight: 700;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
    text-transform: uppercase;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn-add:hover { transform: translateY(-2px); filter: brightness(1.1); }

.tip-text {
    margin-top: 12px;
    color: var(--text-muted);
    font-size: 13px;
    line-height: 1.4;
    background: rgba(255,255,255,0.03);
    padding: 10px;
    border-radius: 6px;
}

/* --- TABLE SECTION --- */
.table-card {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 25px;
    backdrop-filter: blur(12px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    animation: fadeIn 0.8s ease forwards;
}

.table-card h3 {
    font-size: 20px;
    margin-bottom: 20px;
    text-transform: uppercase;
    color: white;
}

table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 10px;
}

th, td { padding: 14px; text-align: left; }

th {
    color: var(--text-muted);
    font-size: 14px;
    text-transform: uppercase;
    border-bottom: 2px solid var(--border);
}

td {
    background: rgba(255, 255, 255, 0.03);
    transition: 0.3s;
}

tr:hover td { background: rgba(56, 189, 248, 0.05); }
tr td:first-child { border-radius: 8px 0 0 8px; }
tr td:last-child { border-radius: 0 8px 8px 0; }

/* Status Pills */
.pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
}

.pill-ok { background: rgba(34, 197, 94, 0.15); color: #bbf7d0; border: 1px solid rgba(34, 197, 94, 0.2); }
.pill-warn { background: rgba(245, 158, 11, 0.15); color: #fde68a; border: 1px solid rgba(245, 158, 11, 0.2); }
.pill-bad { background: rgba(239, 68, 68, 0.15); color: #fecaca; border: 1px solid rgba(239, 68, 68, 0.2); }

.delete-link {
    color: var(--danger);
    text-decoration: none;
    font-weight: 600;
    transition: 0.3s;
}
.delete-link:hover { text-decoration: underline; color: #f87171; }

/* --- RESPONSIVE --- */
@media (max-width: 1024px) {
    .grid-container { grid-template-columns: 1fr; }
}
@media (max-width: 900px) {
    .sidebar { width: 80px; padding: 30px 10px; }
    .sidebar h2, .sidebar a span { display: none; }
    .sidebar a { justify-content: center; padding: 15px 0; }
    .sidebar a::before { margin-right: 0; font-size: 20px; }
    .sidebar a.active { border-left: none; border-right: 4px solid var(--accent); }
    
    .main { margin-left: 80px; width: calc(100% - 80px); padding: 20px; }
    table { display: block; overflow-x: auto; }
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
    <a href="/admin/cars" class="active">Manage Cars</a>
    <a href="/admin/rentals">Bookings</a>
    <a href="/admin/drivers">Drivers</a>
    <a href="/admin/bookings">Customers</a>
    <a href="/admin/logout">Logout</a>
</div>

<!-- MAIN CONTENT -->
<div class="main">

    <div class="page-header">
        <h1>Car Units</h1>
        <p>
            {{ $car->brand }} · <strong style="color:white;">{{ $car->name }}</strong>
            · <a href="/admin/cars" class="back-link"><i class="fas fa-arrow-left"></i> Back to cars</a>
        </p>
    </div>

    <!-- Logic Alerts -->
    @if(isset($schemaReady) && $schemaReady === false)
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i>
            <span>Stock module is not ready. Run `php artisan migrate` to create the `car_units` table.</span>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-times-circle"></i> {{ session('error') }}
        </div>
    @endif

    <!-- Forms Grid -->
    <div class="grid-container" @if(isset($schemaReady) && $schemaReady === false) style="opacity:.6;pointer-events:none;" @endif>
        
        <!-- Add Unit Form -->
        <div class="form-card">
            <h3><i class="fas fa-plus-circle" style="color:var(--accent); margin-right:8px;"></i>Add Single Unit</h3>
            <form method="POST" action="/admin/cars/{{ $car->id }}/units">
                @csrf
                <label class="form-label">Number Plate (optional)</label>
                <div class="input-wrapper">
                    <input type="text" name="number_plate" class="form-input" placeholder="e.g. MH12AB1234">
                </div>
                
                <label class="form-label">Status</label>
                <div class="input-wrapper">
                    <select name="status" class="form-input">
                        <option value="active">Active</option>
                        <option value="maintenance">Maintenance</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                
                <button type="submit" class="btn-add">
                    <i class="fas fa-plus"></i> Add Unit
                </button>
            </form>
        </div>

        <!-- Bulk Add Form -->
        <div class="form-card">
            <h3><i class="fas fa-layer-group" style="color:var(--warning); margin-right:8px;"></i>Bulk Add</h3>
            <form method="POST" action="/admin/cars/{{ $car->id }}/units/bulk">
                @csrf
                <label class="form-label">Count</label>
                <div class="input-wrapper">
                    <input type="number" name="count" class="form-input" min="1" max="200" value="1">
                </div>
                
                <button type="submit" class="btn-add" style="background: linear-gradient(135deg, #64748b, #475569);">
                    <i class="fas fa-boxes"></i> Create Empty Units
                </button>
                
                <div class="tip-text">
                    <i class="fas fa-lightbulb" style="color:var(--warning);"></i> 
                    Tip: Add number plates later. Units without plates can still reserve stock; email will show plate only if filled.
                </div>
            </form>
        </div>
    </div>

    <!-- Units Table -->
    <div class="table-card">
        <h3>Existing Units ({{ $units->count() }})</h3>
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
                    <td style="font-weight:700; color:var(--accent);">{{ $u->id }}</td>
                    <td style="color:white;">{{ $u->number_plate ?: '—' }}</td>
                    <td>
                        @if($u->status === 'active')
                            <span class="pill pill-ok"><i class="fas fa-check"></i> Active</span>
                        @elseif($u->status === 'maintenance')
                            <span class="pill pill-warn"><i class="fas fa-wrench"></i> Maintenance</span>
                        @else
                            <span class="pill pill-bad"><i class="fas fa-times"></i> Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a class="delete-link" href="/admin/cars/{{ $car->id }}/units/delete/{{ $u->id }}" onclick="return confirm('Delete this unit?')">
                            <i class="fas fa-trash-alt"></i> Delete
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>

<!-- SCRIPTS -->
<script>
    /* THREE.JS BACKGROUND */
    const initBg = () => {
        const canvas = document.getElementById('bg-canvas');
        if(!canvas) return;
        
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth/window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ canvas, alpha: true });
        renderer.setSize(window.innerWidth, window.innerHeight);
        
        const geometry = new THREE.IcosahedronGeometry(15, 1);
        const material = new THREE.MeshBasicMaterial({ color: 0x38bdf8, wireframe: true, transparent: true, opacity: 0.05 });
        const shape = new THREE.Mesh(geometry, material);
        scene.add(shape);

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