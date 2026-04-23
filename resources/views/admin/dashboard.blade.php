<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Car Rental Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Modern Tech Font -->
<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&display=swap" rel="stylesheet">
<!-- Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- Libraries -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

<style>
:root {
    --bg-dark: #0f172a;
    --card-bg: rgba(30, 41, 59, 0.7);
    --border: rgba(255, 255, 255, 0.1);
    --accent: #38bdf8; /* Light Blue */
    --accent2: #f472b6; /* Pink */
    --text-white: #f8fafc;
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
    perspective: 1200px;
}

/* --- HERO --- */
.hero {
    height: 220px;
    background: linear-gradient(to right, rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.4)), url('https://images.unsplash.com/photo-1503376780353-7e6692767b70') center/cover;
    border-radius: 16px;
    display: flex;
    align-items: flex-end;
    padding: 30px;
    margin-bottom: 40px;
    border: 1px solid var(--border);
    box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    opacity: 0;
    transform: translateY(-30px);
    animation: slideDown 1s ease forwards;
}

@keyframes slideDown { to { opacity: 1; transform: translateY(0); } }

.hero h2 { font-size: 42px; font-weight: 700; text-shadow: 0 2px 10px rgba(0,0,0,0.5); }

/* --- FLOATING CARDS --- */
.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}

.card {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 20px;
    position: relative;
    animation: float 6s ease-in-out infinite;
    backdrop-filter: blur(12px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    opacity: 0;
    transform: translateY(50px);
    transition: all 0.5s ease-out;
    cursor: pointer;
    overflow: hidden;
}

.card:nth-child(1) { animation-delay: 0s; border-bottom: 4px solid var(--accent); }
.card:nth-child(2) { animation-delay: 1s; border-bottom: 4px solid var(--accent2); }
.card:nth-child(3) { animation-delay: 2s; border-bottom: 4px solid #34d399; }
.card:nth-child(4) { animation-delay: 3s; border-bottom: 4px solid #fbbf24; }

@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0px); }
}

.card.visible { opacity: 1; transform: translateY(0); }

.card:hover {
    transform: scale(1.05) translateY(-15px) !important;
    background: rgba(30, 41, 59, 0.9);
    box-shadow: 0 20px 50px rgba(56, 189, 248, 0.2);
    z-index: 10;
}

.card p { font-size: 14px; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; }
.card h3 { font-size: 36px; font-weight: 700; color: white; line-height: 1; text-shadow: 0 0 15px rgba(255,255,255,0.1); }

/* --- CHARTS --- */
.charts {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.chart-box {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 20px;
    backdrop-filter: blur(12px);
    opacity: 0;
    transform: scale(0.9);
    transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.chart-box.visible { opacity: 1; transform: scale(1); }
.chart-box:hover { border-color: var(--accent); transform: scale(1.02); }

/* --- TABLE SECTION (FIXED & STYLED) --- */
/* Header Styling */
.main h2[style] {
    color: transparent !important; /* Override inline style */
    background: linear-gradient(to right, #fff, #94a3b8);
    -webkit-background-clip: text;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-top: 50px !important;
    margin-bottom: 20px !important;
}

/* Review Card - Auto Fade In */
.review-card {
    background: var(--card-bg);
    border: 1px solid var(--border);
    padding: 25px;
    border-radius: 16px;
    backdrop-filter: blur(12px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    /* Animation Fix: Auto plays on load */
    opacity: 0;
    animation: slideInUp 1s ease forwards;
    animation-delay: 0.5s;
}

@keyframes slideInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Table Styling */
.review-table { 
    width: 100%; 
    border-collapse: separate; 
    border-spacing: 0 10px; 
}

.review-table thead { 
    background: transparent; 
}

.review-table th { 
    padding: 12px; 
    text-align: left; 
    color: #94a3b8; 
    font-size: 14px; 
    text-transform: uppercase; 
    border-bottom: 2px solid var(--border);
}

.review-table td { 
    background: rgba(255,255,255,0.03); 
    padding: 16px; 
    color: #e2e8f0;
    transition: 0.3s;
}

/* Hover Effect on Rows */
.review-table tbody tr:hover td { 
    background: rgba(56, 189, 248, 0.05); 
    transform: scale(1.01);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* First and Last cell radius */
.review-table tr td:first-child { border-radius: 8px 0 0 8px; }
.review-table tr td:last-child { border-radius: 0 8px 8px 0; }

/* Rating Badge */
.rating {
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
    color: #0f172a;
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: bold;
    font-size: 12px;
    box-shadow: 0 4px 10px rgba(251, 191, 36, 0.3);
}

/* Mobile Responsive */
@media (max-width: 900px) {
    .sidebar { width: 70px; padding: 20px 10px; }
    .sidebar h2, .sidebar a span { display: none; }
    .sidebar a { justify-content: center; padding: 15px 0; }
    .sidebar a::before { margin-right: 0; font-size: 20px; }
    .main { margin-left: 70px; padding: 20px; }
    .hero h2 { font-size: 24px; }
    .charts { grid-template-columns: 1fr; }
}
</style>
</head>

<body>

<!-- 3D Background -->
<canvas id="bg-canvas"></canvas>

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
<div class="hero"><h2>Om Shanti Travels</h2></div>

<div class="cards">
<div class="card"><h3>{{ $totalCars }}</h3><p>Total Cars</p></div>
<div class="card"><h3>{{ $totalBookings }}</h3><p>Total Bookings</p></div>
<div class="card"><h3>{{ $totalCustomers }}</h3><p>Total Customers</p></div>
<div class="card"><h3>{{ $totalMessages }}</h3><p>Contact Messages</p></div>
</div>

<div class="charts">
<div class="chart-box"><canvas id="bookingChart"></canvas></div>
<div class="chart-box"><canvas id="customerChart"></canvas></div>
<div class="chart-box"><canvas id="revenueChart"></canvas></div>
</div>

<script>
/* 1. SCROLL ANIMATIONS */
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if(entry.isIntersecting) {
            entry.target.classList.add('visible');
            observer.unobserve(entry.target);
        }
    });
}, { threshold: 0.1 });

document.querySelectorAll('.card, .chart-box').forEach(el => observer.observe(el));

/* 2. THREE.JS BACKGROUND */
const initBg = () => {
    const canvas = document.getElementById('bg-canvas');
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
        shape.rotation.x += 0.001; shape.rotation.y += 0.001;
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

/* 3. CHARTS */
const initCharts = () => {
    Chart.defaults.color = '#94a3b8';
    Chart.defaults.font.family = 'Rajdhani';
    Chart.defaults.borderColor = 'rgba(255, 255, 255, 0.05)';

    new Chart(document.getElementById("bookingChart"), {
        type: "line",
        data: {
            labels: {!! json_encode($bookingMonths) !!},
            datasets: [{
                label: "Monthly Bookings",
                data: {!! json_encode($bookingTotals) !!},
                borderColor: "#38bdf8",
                backgroundColor: "rgba(56, 189, 248, 0.2)",
                tension: 0.4, fill: true, borderWidth: 3
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { grid: { color: 'rgba(255,255,255,0.05)' } }, x: { grid: { display: false } } } }
    });

    new Chart(document.getElementById("customerChart"), {
        type: "bar",
        data: {
            labels: {!! json_encode($months) !!},
            datasets: [{
                label: "Customer Growth",
                data: {!! json_encode($totals) !!},
                backgroundColor: "#22c55e", borderRadius: 5
            }]
        },
        options: { responsive: true, plugins: { legend: { display: true, position: 'bottom' } }, scales: { y: { grid: { display: false } }, x: { grid: { display: false } } } }
    });

    new Chart(document.getElementById("revenueChart"), {
        type: "doughnut",
        data: {
            labels: ["Cars", "Customers"],
            datasets: [{
                data: [{{ $totalCars }}, {{ $totalCustomers }}],
                backgroundColor: ["#3b82f6", "#f472b6"], borderWidth: 0, hoverOffset: 10
            }]
        },
        options: { responsive: true, cutout: '75%', plugins: { legend: { position: 'bottom' } } }
    });
};

window.onload = () => {
    initBg();
    initCharts();
};
</script>

<!-- ACTIVITY / REVIEWS (NOW WITH AUTO-FIX) -->
<h2 style="margin-top:30px;color:white;">Customer Reviews</h2>

<div class="review-card">
<table class="review-table">
<thead>
<tr>
<th>Name</th>
<th>Rating</th>
<th>Message</th>
</tr>
</thead>
<tbody>
@foreach($reviews as $review)
<tr>
<td style="font-weight: 700; color: white;">{{$review->name}}</td>
<td><span class="rating">{{$review->rating}} ⭐</span></td>
<td>{{$review->message}}</td>
</tr>
@endforeach
</tbody>
</table>
</div>

</div>
</body>
</html>