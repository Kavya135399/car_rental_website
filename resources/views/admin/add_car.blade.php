<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Car - Om Shanti Travels</title>
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

/* --- SIDEBAR (Matches Manage Cars Page) --- */
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
    max-width: 900px;
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

/* --- FORM CARD --- */
.form-card {
    width: 100%;
    max-width: 900px;
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 40px;
    backdrop-filter: blur(12px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    animation: fadeIn 0.8s ease forwards;
}

@keyframes fadeIn { to { opacity: 1; transform: translateY(0); } }

/* Form Grid System - 2 Columns */
.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 25px;
    margin-bottom: 25px;
}

.form-group { position: relative; }
.form-group.full-width { grid-column: span 2; }

.form-label {
    display: block;
    color: var(--text-muted);
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.input-wrapper { position: relative; }

.input-wrapper i {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    transition: color 0.3s;
    pointer-events: none;
}

.form-input {
    width: 100%;
    padding: 14px 16px 14px 46px; /* Add padding for icon */
    border-radius: 8px;
    border: 1px solid var(--border);
    background: var(--input-bg);
    color: white;
    font-size: 16px;
    transition: all 0.3s;
}

.form-input:focus {
    outline: none;
    border-color: var(--accent);
    background: rgba(15, 23, 42, 0.8);
    box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.1);
}

.form-input:focus + i { color: var(--accent); }

textarea.form-input {
    padding: 16px;
    min-height: 120px;
    resize: vertical;
}

/* --- IMAGE UPLOAD (PERFECT UI) --- */
.upload-wrapper {
    position: relative;
    border: 2px dashed var(--border);
    border-radius: 12px;
    background: var(--input-bg);
    cursor: pointer;
    transition: all 0.3s;
    overflow: hidden;
    min-height: 220px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.upload-wrapper:hover {
    border-color: var(--accent);
    background: rgba(56, 189, 248, 0.05);
}

.upload-wrapper input[type="file"] {
    display: none; /* Hide default ugly input */
}

.upload-placeholder {
    text-align: center;
    padding: 20px;
    z-index: 1;
    pointer-events: none;
}

.upload-placeholder i {
    font-size: 48px;
    color: var(--accent);
    margin-bottom: 15px;
    display: block;
}

.upload-placeholder p {
    color: var(--text-muted);
    font-size: 16px;
    margin-bottom: 5px;
}

.upload-placeholder span {
    font-size: 12px;
    color: #64748b;
}

/* Preview Image Style */
.upload-preview {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0; left: 0;
    display: none; /* Hidden by default */
    opacity: 0.9;
}

/* Toggle Switch */
.toggle-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: var(--input-bg);
    padding: 12px 16px;
    border-radius: 8px;
    border: 1px solid var(--border);
}

.toggle-label {
    font-weight: 600;
    color: white;
}

.switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 26px;
}

.switch input { opacity: 0; width: 0; height: 0; }

.slider {
    position: absolute;
    cursor: pointer;
    top: 0; left: 0; right: 0; bottom: 0;
    background-color: #334155;
    transition: .4s;
    border-radius: 34px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 20px;
    width: 20px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}

input:checked + .slider { background-color: var(--accent); }
input:checked + .slider:before { transform: translateX(24px); }

/* Submit Button */
.btn-submit {
    width: 100%;
    padding: 16px;
    background: linear-gradient(135deg, var(--accent), #0ea5e9);
    color: #0f172a;
    font-size: 18px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    margin-top: 10px;
    transition: all 0.3s;
    box-shadow: 0 4px 15px rgba(56, 189, 248, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(56, 189, 248, 0.5);
}

/* --- RESPONSIVE DESIGN --- */
@media (max-width: 1024px) {
    .form-grid { grid-template-columns: 1fr; }
    .form-group.full-width { grid-column: span 1; }
}

@media (max-width: 900px) {
    /* Sidebar collapses to icons only */
    .sidebar { width: 80px; padding: 30px 10px; }
    .sidebar h2, .sidebar a span { display: none; }
    .sidebar h2 { font-size: 24px; text-align: center; }
    .sidebar a { justify-content: center; padding: 15px 0; }
    .sidebar a::before { margin-right: 0; font-size: 20px; }
    .sidebar a.active { border-left: none; border-right: 4px solid var(--accent); }
    
    /* Main fills space */
    .main { margin-left: 80px; width: calc(100% - 80px); padding: 20px; }
}
</style>
</head>
<body>

<!-- 3D Background -->
<canvas id="bg-canvas"></canvas>

<!-- SIDEBAR (Identical to Manage Cars) -->
<div class="sidebar">
    <h2>🚗 Admin</h2>
    <a href="/admin/dashboard">Dashboard</a>
    <!-- Active link points to parent page -->
    <a href="/admin/cars" class="active">Manage Cars</a>
    <a href="/admin/rentals">Bookings</a>
    <a href="/admin/drivers">Drivers</a>
    <a href="/admin/bookings">Customers</a>
    <a href="/admin/logout">Logout</a>
</div>

<!-- MAIN CONTENT -->
<div class="main">

    <div class="page-header">
        <h1>Add New Vehicle</h1>
        <p>Fill in the details below to add a new car to the fleet.</p>
    </div>

    <div class="form-card">
        <form method="POST" action="/admin/cars/save" enctype="multipart/form-data">
            @csrf

            <!-- Row 1 -->
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Car Name</label>
                    <div class="input-wrapper">
                        <input type="text" name="name" class="form-input" placeholder="e.g. Toyota Fortuner" required>
                        <i class="fas fa-car"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Brand</label>
                    <div class="input-wrapper">
                        <input type="text" name="brand" class="form-input" placeholder="e.g. Toyota" required>
                        <i class="fas fa-tag"></i>
                    </div>
                </div>
            </div>

            <!-- Row 2 -->
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Price Per Day (₹)</label>
                    <div class="input-wrapper">
                        <input type="number" name="price_per_day" class="form-input" placeholder="5000" step="1">
                        <i class="fas fa-rupee-sign"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Seats</label>
                    <div class="input-wrapper">
                        <input type="number" name="seats" class="form-input" placeholder="6" min="1">
                        <i class="fas fa-chair"></i>
                    </div>
                </div>
            </div>

            <!-- Row 3 -->
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Fuel Type</label>
                    <div class="input-wrapper">
                        <input type="text" name="fuel_type" class="form-input" placeholder="Petrol / Diesel / Hybrid">
                        <i class="fas fa-gas-pump"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Transmission</label>
                    <div class="input-wrapper">
                        <input type="text" name="transmission" class="form-input" placeholder="Manual / Automatic">
                        <i class="fas fa-cogs"></i>
                    </div>
                </div>
            </div>

            <!-- Row 4: Featured -->
            <div class="form-grid">
                <div class="form-group full-width">
                    <div class="toggle-container">
                        <span class="toggle-label">Mark as Featured</span>
                        <label class="switch">
                            <input type="checkbox" name="featured" value="1">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Row 5: Description -->
            <div class="form-group" style="margin-bottom: 25px;">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-input" placeholder="Write details about the car condition, features, etc..." style="padding-left: 16px;"></textarea>
            </div>

            <!-- Row 6: Image Upload (Perfect UI) -->
            <div class="form-group" style="margin-bottom: 30px;">
                <label class="form-label">Car Image</label>
                <label class="upload-wrapper" id="imageUploadBox">
                    <input type="file" name="image" id="imageInput" accept="image/*">
                    <!-- Default Placeholder -->
                    <div class="upload-placeholder" id="placeholder">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Click to upload image</p>
                        <span>JPG, PNG or WEBP (Max 5MB)</span>
                    </div>
                    <!-- Image Preview -->
                    <img id="imagePreview" class="upload-preview">
                </label>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Save Vehicle
            </button>
        </form>
    </div>

</div>

<!-- SCRIPTS -->
<script>
    /* 1. IMAGE UPLOAD PREVIEW LOGIC */
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');
    const placeholder = document.getElementById('placeholder');

    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Show image
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
                // Hide placeholder text
                placeholder.style.display = 'none';
            }
            reader.readAsDataURL(file);
        }
    });

    /* 2. THREE.JS BACKGROUND */
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