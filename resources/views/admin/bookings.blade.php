<!DOCTYPE html>
<html>
<head>
<title>Contact Messages - Om Shanti Travels</title>

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

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Rajdhani',sans-serif;
}

body{
display:flex;
background:var(--bg-dark);
color:var(--text-white);
overflow-x:auto;
min-height:100vh;
}

/* --- 3D BACKGROUND --- */
#bg-canvas{position:fixed;top:0;left:0;width:100%;height:100%;z-index:-1;opacity:.4;pointer-events:none;}

/* --- SIDEBAR --- */
.sidebar{
width:260px;
min-width:260px;
height:100vh;
background:rgba(15,23,42,.95);
backdrop-filter:blur(10px);
border-right:1px solid var(--border);
padding:30px 20px;
position:fixed;
z-index:100;
display:flex;
flex-direction:column;
overflow-y:auto;
}

.sidebar h2{
font-size:28px;
font-weight:700;
color:white;
margin-bottom:50px;
text-transform:uppercase;
letter-spacing:2px;
text-shadow:0 0 10px var(--accent);
}

.sidebar a{
display:flex;
align-items:center;
padding:15px;
color:#cbd5e1;
text-decoration:none;
border-radius:10px;
margin-bottom:10px;
transition:.3s;
font-size:18px;
font-weight:600;
white-space:nowrap;
}

.sidebar a::before{
font-family:'Font Awesome 6 Free';
font-weight:900;
margin-right:15px;
color:var(--accent);
width:20px;
text-align:center;
flex-shrink:0;
}

.sidebar a[href*="dashboard"]::before{content:'\f00a';}
.sidebar a[href*="cars"]::before{content:'\f1b9';}
.sidebar a[href*="rentals"]::before{content:'\f073';}
.sidebar a[href*="drivers"]::before{content:'\f084';}
.sidebar a[href*="bookings"]::before{content:'\f0c0';}
.sidebar a[href*="messages"]::before{content:'\f0e0';}
.sidebar a[href*="logout"]::before{content:'\f2f5';color:#ef4444;}

.sidebar a:hover,
.sidebar a.active{
background:rgba(56,189,248,.1);
color:white;
transform:translateX(10px);
border-left:4px solid var(--accent);
}

/* --- MAIN --- */
.main{
margin-left:260px;
width:calc(100% - 260px);
min-width:900px;
padding:40px;
}

.main>h1{
font-size:32px;
font-weight:700;
background:linear-gradient(to right,#fff,#94a3b8);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
text-transform:uppercase;
letter-spacing:1px;
margin-bottom:25px;
animation:slideDown .6s ease;
}

@keyframes slideDown{from{opacity:0;transform:translateY(-20px);}to{opacity:1;transform:translateY(0);}}
@keyframes fadeIn{from{opacity:0;transform:translateY(15px);}to{opacity:1;transform:translateY(0);}}

/* --- TABLE BOX --- */
.table-box{
background:var(--card-bg);
border:1px solid var(--border);
border-radius:16px;
padding:25px;
backdrop-filter:blur(12px);
box-shadow:0 20px 40px rgba(0,0,0,.3);
overflow-x:auto;
animation:fadeIn .8s ease forwards;
}

/* --- TABLE --- */
table{
width:100%;
border-collapse:separate;
border-spacing:0;
min-width:960px;
}

thead tr{
background:rgba(15,23,42,.6);
}

th{
padding:14px 16px;
text-align:left;
color:var(--text-muted);
font-size:13px;
font-weight:700;
text-transform:uppercase;
letter-spacing:.8px;
border-bottom:1px solid var(--border);
white-space:nowrap;
}

th:first-child{border-radius:10px 0 0 0;}
th:last-child{border-radius:0 10px 0 0;}

td{
padding:16px;
text-align:left;
border-bottom:1px solid rgba(255,255,255,.05);
font-size:15px;
line-height:1.5;
color:#cbd5e1;
vertical-align:top;
}

tbody tr{
transition:background .2s;
}

tbody tr:hover{
background:rgba(56,189,248,.04);
}

/* Message column - cap width so it doesn't explode */
td:nth-child(5){
max-width:300px;
overflow:hidden;
text-overflow:ellipsis;
white-space:nowrap;
color:var(--text-muted);
font-size:14px;
}

/* --- BUTTONS --- */
.reply-btn{
display:inline-flex;
align-items:center;
gap:6px;
background:linear-gradient(135deg,#22c55e,#16a34a);
padding:8px 16px;
border-radius:8px;
color:white;
text-decoration:none;
font-weight:700;
font-size:13px;
text-transform:uppercase;
letter-spacing:.5px;
transition:all .3s;
box-shadow:0 4px 15px rgba(34,197,94,.25);
white-space:nowrap;
}

.reply-btn:hover{
transform:translateY(-2px);
box-shadow:0 6px 20px rgba(34,197,94,.4);
}

.reply-btn::before{
content:'\f0e0';
font-family:'Font Awesome 6 Free';
font-weight:900;
font-size:12px;
}

.delete-btn{
display:inline-flex;
align-items:center;
gap:6px;
background:linear-gradient(135deg,#ef4444,#dc2626);
padding:8px 16px;
border-radius:8px;
color:white;
text-decoration:none;
font-weight:700;
font-size:13px;
text-transform:uppercase;
letter-spacing:.5px;
transition:all .3s;
box-shadow:0 4px 15px rgba(239,68,68,.25);
white-space:nowrap;
}

.delete-btn:hover{
transform:translateY(-2px);
box-shadow:0 6px 20px rgba(239,68,68,.4);
}

.delete-btn::before{
content:'\f2ed';
font-family:'Font Awesome 6 Free';
font-weight:900;
font-size:12px;
}

/* ID column style */
td:first-child{
font-weight:700;
color:var(--accent);
font-size:14px;
}

/* Name column */
td:nth-child(2){
font-weight:700;
color:white;
}

/* Email column */
td:nth-child(3){
color:var(--accent);
font-size:14px;
}

/* Subject column */
td:nth-child(4){
font-weight:600;
color:white;
}

/* --- SCROLLBAR --- */
::-webkit-scrollbar{width:6px;height:6px;}
::-webkit-scrollbar-track{background:transparent;}
::-webkit-scrollbar-thumb{background:rgba(255,255,255,.1);border-radius:10px;}
::-webkit-scrollbar-thumb:hover{background:rgba(255,255,255,.2);}

/* --- RESPONSIVE --- */
@media(max-width:900px){
    .sidebar{width:80px;min-width:80px;padding:30px 10px;}
    .sidebar h2{display:none;}
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
    .table-box{padding:14px;}
    table{display:block;overflow-x:auto;-webkit-overflow-scrolling:touch;min-width:960px;}
    th,td{white-space:nowrap;}
}

</style>
</head>

<body>

<canvas id="bg-canvas"></canvas>

<!-- SIDEBAR -->

<div class="sidebar">
<h2>🚗 Admin</h2>
<a href="/admin/dashboard">Dashboard</a>
<a href="/admin/cars">Manage Cars</a>
<a href="/admin/rentals">Bookings</a>
<a href="/admin/drivers">Drivers</a>
<a href="/admin/bookings">Customers</a>
<a href="/admin/logout">Logout</a>
</div>

<!-- MAIN -->

<div class="main">
<h1 style="margin-bottom:25px;">Customer Contact Messages</h1>

<div class="table-box">

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Subject</th>
<th>Message</th>
<th>Action</th>
</tr>

@foreach($messages as $msg)

<tr>

<td>{{ $msg->id }}</td>
<td>{{ $msg->name }}</td>
<td>{{ $msg->email }}</td>
<td>{{ $msg->subject }}</td>
<td>{{ $msg->message }}</td>

<td>

<a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $msg->email }}&su=Reply%20to%20your%20message" 
target="_blank" 
class="reply-btn">
Reply
</a>

<a href="/admin/messages/delete/{{$msg->id}}" class="delete-btn">Delete</a>
<!-- <form action="/admin/messages/delete/{{$msg->id}}" method="POST">
@csrf
<button class="delete-btn">Delete</button>
</form>
</td> -->

</tr>

@endforeach

</table>

</div>

</div>

<script>
const initBg=()=>{const c=document.getElementById('bg-canvas');if(!c)return;const s=new THREE.Scene(),cam=new THREE.PerspectiveCamera(75,innerWidth/innerHeight,.1,1e3),r=new THREE.WebGLRenderer({canvas:c,alpha:true});r.setSize(innerWidth,innerHeight);const g=new THREE.IcosahedronGeometry(15,1),m=new THREE.MeshBasicMaterial({color:0x38bdf8,wireframe:true,transparent:true,opacity:.05}),sh=new THREE.Mesh(g,m);s.add(sh);const pg=new THREE.BufferGeometry(),pc=200,pa=new Float32Array(pc*3);for(let i=0;i<pc*3;i++)pa[i]=(Math.random()-.5)*50;pg.setAttribute('position',new THREE.BufferAttribute(pa,3));const pt=new THREE.Points(pg,new THREE.PointsMaterial({size:.05,color:0xffffff,transparent:true,opacity:.5}));s.add(pt);cam.position.z=25;(function a(){requestAnimationFrame(a);sh.rotation.x+=.001;sh.rotation.y+=.001;pt.rotation.y-=.0005;r.render(s,cam)})();addEventListener('resize',()=>{cam.aspect=innerWidth/innerHeight;cam.updateProjectionMatrix();r.setSize(innerWidth,innerHeight)})};
window.onload=initBg;
</script>

</body>
</html>