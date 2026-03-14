
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Car Rental Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
background:#0f172a;
color:white;
display:flex;
}

/* SIDEBAR */

.sidebar{
width:230px;
height:100vh;
background:#020617;
padding:20px;
position:fixed;
}

.sidebar h2{
margin-bottom:40px;
}

.sidebar a{
display:block;
color:#cbd5f5;
padding:12px;
margin-bottom:10px;
text-decoration:none;
border-radius:6px;
transition:0.3s;
}

.sidebar a:hover{
background:#1e293b;
}

/* MAIN */

.main{
margin-left:230px;
padding:30px;
width:100%;
}

/* HERO */

.hero{
height:200px;
background:url('https://images.unsplash.com/photo-1503376780353-7e6692767b70') center/cover;
border-radius:12px;
display:flex;
align-items:end;
padding:20px;
margin-bottom:30px;
}

/* CARDS */

.cards{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
gap:20px;
margin-bottom:30px;
}

.card{
background:rgba(255,255,255,0.05);
backdrop-filter:blur(10px);
padding:20px;
border-radius:12px;
box-shadow:0 5px 20px rgba(0,0,0,0.5);
transition:0.3s;
}

.card:hover{
transform:translateY(-5px);
background:rgba(255,255,255,0.1);
}

.card h3{
font-size:28px;
margin-bottom:5px;
}

.card p{
color:#94a3b8;
}

/* CHARTS */

.charts{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(300px,1fr));
gap:20px;
margin-bottom:30px;
}

.chart-box{
background:#020617;
padding:20px;
border-radius:12px;
}

/* ACTIVITY */

.activity{
background:#020617;
padding:20px;
border-radius:12px;
}

.activity h3{
margin-bottom:15px;
}

.activity ul{
list-style:none;
}

.activity li{
padding:10px 0;
border-bottom:1px solid #1e293b;
color:#cbd5f5;
}

</style>
</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

<h2>🚗 Admin</h2>

<a href="/admin/dashboard">Dashboard</a>
<a href="/admin/cars">Manage Cars</a>
<a href="/admin/bookings">Customers</a>
<a href="/admin">Logout</a>

</div>

<!-- MAIN -->

<div class="main">

<!-- HERO -->

<div class="hero">
<h2>Om Shanti Travels</h2>
</div>

<!-- CARDS -->

<div class="cards">

<div class="card">
<h3>120</h3>
<p>Total Cars</p>
</div>

<div class="card">
<h3>340</h3>
<p>Total Bookings</p>
</div>

<div class="card">
<h3>210</h3>
<p>Total Customers</p>
</div>

<div class="card">
<h3>45</h3>
<p>Contact Messages</p>
</div>

</div>

<!-- CHARTS -->

<div class="charts">

<div class="chart-box">
<canvas id="bookingChart"></canvas>
</div>

<div class="chart-box">
<canvas id="customerChart"></canvas>
</div>

<div class="chart-box">
<canvas id="revenueChart"></canvas>
</div>

</div>

<!-- ACTIVITY -->

<div class="activity">

<h3>Recent Customer Activity</h3>

<ul>
<li>Rahul booked Toyota Fortuner</li>
<li>Priya sent contact message</li>
<li>Amit booked Swift Dzire</li>
<li>Neha registered new account</li>
</ul>

</div>

</div>

<script>

/* BOOKINGS CHART */

new Chart(document.getElementById("bookingChart"),{

type:"line",

data:{
labels:["Jan","Feb","Mar","Apr","May","Jun"],
datasets:[{
label:"Monthly Bookings",
data:[20,40,60,50,70,90],
borderColor:"#38bdf8",
backgroundColor:"rgba(56,189,248,0.2)"
}]
}

});

/* CUSTOMER CHART */

new Chart(document.getElementById("customerChart"),{

type:"bar",

data:{
labels:["Jan","Feb","Mar","Apr","May"],
datasets:[{
label:"Customer Growth",
data:[10,25,40,60,80],
backgroundColor:"#22c55e"
}]
}

});

/* REVENUE */

new Chart(document.getElementById("revenueChart"),{

type:"doughnut",

data:{
labels:["Cars","Bookings","Services"],
datasets:[{
data:[40,35,25],
backgroundColor:["#3b82f6","#22c55e","#f59e0b"]
}]
}

});

</script>

</body>
</html>