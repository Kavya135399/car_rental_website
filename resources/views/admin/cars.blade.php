<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Cars - Om Shanti Travels</title>
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
    --accent2: #f472b6; /* Pink */
    --text-white: #f8fafc;
    --success: #22c55e;
    --danger: #ef4444;
    --warning: #f59e0b;
}

* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Rajdhani', sans-serif; }

body {
    background-color: var(--bg-dark);
    color: var(--text-white);
    overflow-x: hidden;
}

/* --- 3D BACKGROUND --- */
#bg-canvas {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    z-index: -1;
    opacity: 0.4;
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
    position: relative;
}

/* --- HEADER --- */
.header{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    animation: slideDown 1s ease forwards;
}

@keyframes slideDown { 
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); } 
}

.header h1 {
    font-size: 36px;
    font-weight: 700;
    background: linear-gradient(to right, #fff, #94a3b8);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* ADD BUTTON */
.add-btn{
    padding: 12px 24px;
    background: linear-gradient(135deg, var(--accent), #0ea5e9);
    color: #0f172a;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 0 4px 15px rgba(56, 189, 248, 0.4);
    transition: 0.3s;
}

.add-btn:hover{
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(56, 189, 248, 0.6);
}

/* TABLE BOX (Glassmorphism Card) */
.table-box{
    background: var(--card-bg);
    padding: 25px;
    border-radius: 16px;
    border: 1px solid var(--border);
    backdrop-filter: blur(12px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    opacity: 0;
    animation: fadeIn 1s ease forwards;
    animation-delay: 0.3s;
}

@keyframes fadeIn { to { opacity: 1; } }

/* Success Message Styling */
.success-msg {
    background: rgba(34, 197, 94, .15);
    border: 1px solid rgba(34, 197, 94, .35);
    padding: 14px;
    border-radius: 10px;
    margin-bottom: 20px;
    color: #bbf7d0;
    display: flex;
    align-items: center;
    font-weight: 600;
}

.success-msg::before {
    content: '\f00c';
    font-family: 'Font Awesome 6 Free';
    font-weight: 900;
    margin-right: 10px;
    font-size: 18px;
}

/* TABLE STYLING */
table{
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 12px;
}

th, td{
    padding: 16px;
    text-align: center;
}

th{
    color: #94a3b8;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 1px;
    border-bottom: 2px solid var(--border);
}

td {
    background: rgba(255, 255, 255, 0.03);
    transition: 0.3s;
}

/* Row Hover Effect */
tbody tr:hover td { 
    background: rgba(56, 189, 248, 0.05); 
    transform: scale(1.01);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Rounded corners for table rows */
tr td:first-child { border-radius: 8px 0 0 8px; }
tr td:last-child { border-radius: 0 8px 8px 0; }

/* Image Styling */
.car-img {
    width: 90px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid rgba(255,255,255,0.1);
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
}

/* Action Buttons */
.action-btn {
    padding: 8px 14px;
    border-radius: 6px;
    text-decoration: none;
    color: white;
    font-weight: 600;
    font-size: 14px;
    margin: 0 3px;
    display: inline-block;
    transition: 0.3s;
}

.edit-btn { background: var(--accent); color: #0f172a; }
.edit-btn:hover { background: #7dd3fc; transform: translateY(-2px); }

.units-btn { background: var(--warning); color: #0f172a; }
.units-btn:hover { background: #fbbf24; transform: translateY(-2px); }

.delete-btn { background: var(--danger); }
.delete-btn:hover { background: #f87171; transform: translateY(-2px); }

/* Responsive */
@media (max-width: 900px) {
    .sidebar { width: 70px; padding: 20px 10px; }
    .sidebar h2, .sidebar a span { display: none; }
    .sidebar a { justify-content: center; padding: 15px 0; }
    .sidebar a::before { margin-right: 0; font-size: 20px; }
    .main { margin-left: 70px; padding: 20px; }
    .header h1 { font-size: 24px; }
    table { display: block; overflow-x: auto; white-space: nowrap; }
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
    <!-- Mark current page active -->
    <a href="/admin/cars" class="active">Manage Cars</a>
    <a href="/admin/rentals">Bookings</a>
    <a href="/admin/drivers">Drivers</a>
    <a href="/admin/bookings">Customers</a>
    <a href="/admin/logout">Logout</a>
</div>

<!-- MAIN CONTENT -->
<div class="main">

    <div class="header">
        <h1>Manage Cars</h1>
        <a href="/admin/cars/add" class="add-btn">+ Add New Car</a>
    </div>

    <div class="table-box">
        
        @if(session('success'))
            <div class="success-msg">
                {{ session('success') }}
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Car Name</th>
                    <th>Brand</th>
                    <th>Price/Day</th>
                    <th>Units</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cars as $car)
                <tr>
                    <td style="font-weight:700; color:var(--accent);">{{ $car->id }}</td>
                    <td style="color:white; font-weight:600;">{{ $car->name }}</td>
                    <td>{{ $car->brand }}</td>
                    <td>
                        @if(!is_null($car->price_per_day))
                            <span style="color:#34d399; font-weight:600;">₹{{ number_format($car->price_per_day) }}</span>
                        @else
                            —
                        @endif
                    </td>
                    <td>
                        <span style="background:rgba(255,255,255,0.1); padding:4px 10px; border-radius:20px; font-size:14px;">
                            {{ $car->units_total ?? 0 }}
                        </span>
                    </td>

                    <td>
                        @php
                          $img = null;
                          if ($car->image) {
                            $img = \Illuminate\Support\Str::startsWith($car->image, ['cars_uploads/', 'cars/', 'public/'])
                              ? asset('storage/' . $car->image)
                              : asset('images/' . $car->image);
                          }
                        @endphp
                        @if($img)
                          <img src="{{ $img }}" class="car-img">
                        @else
                          <span style="color:#64748b; font-size:12px;">No Image</span>
                        @endif
                    </td>

                    <td>
                        <a href="/admin/cars/edit/{{$car->id}}" class="action-btn edit-btn">
                            <i class="fas fa-pen"></i> Edit
                        </a>
                        
                        <a href="/admin/cars/{{$car->id}}/units" class="action-btn units-btn">
                            <i class="fas fa-layer-group"></i> Units
                        </a>

                        <a href="/admin/cars/delete/{{$car->id}}" class="action-btn delete-btn" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>

<!-- 3D BACKGROUND SCRIPT -->
<script>
    const initBg = () => {
        const canvas = document.getElementById('bg-canvas');
        if(!canvas) return;
        
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth/window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ canvas, alpha: true });
        renderer.setSize(window.innerWidth, window.innerHeight);
        
        // Wireframe Shape
        const geometry = new THREE.IcosahedronGeometry(15, 1);
        const material = new THREE.MeshBasicMaterial({ color: 0x38bdf8, wireframe: true, transparent: true, opacity: 0.05 });
        const shape = new THREE.Mesh(geometry, material);
        scene.add(shape);

        // Particles
        const partGeo = new THREE.BufferGeometry();
        const partCount = 300;
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