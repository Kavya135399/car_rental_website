<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Car Rental Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{background:#0f172a;color:white;display:flex;}
.sidebar{width:230px;height:100vh;background:#020617;padding:20px;position:fixed;}
.sidebar h2{margin-bottom:40px;}
.sidebar a{display:block;color:#cbd5f5;padding:12px;margin-bottom:10px;text-decoration:none;border-radius:6px;transition:0.3s;}
.sidebar a:hover{background:#1e293b;}
.main{margin-left:230px;padding:30px;width:100%;}
.hero{height:200px;background:url('https://images.unsplash.com/photo-1503376780353-7e6692767b70') center/cover;border-radius:12px;display:flex;align-items:end;padding:20px;margin-bottom:30px;}
.cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;margin-bottom:30px;}
.card{background:rgba(255,255,255,0.05);backdrop-filter:blur(10px);padding:20px;border-radius:12px;box-shadow:0 5px 20px rgba(0,0,0,0.5);transition:0.3s;}
.card:hover{transform:translateY(-5px);background:rgba(255,255,255,0.1);}
.card h3{font-size:28px;margin-bottom:5px;}
.card p{color:#94a3b8;}
.charts{display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:20px;margin-bottom:30px;}
.chart-box{background:#020617;padding:20px;border-radius:12px;}
.activity{background:#020617;padding:20px;border-radius:12px;}
.activity h3{margin-bottom:15px;}
.activity ul{list-style:none;}
.activity li{padding:10px 0;border-bottom:1px solid #1e293b;color:#cbd5f5;}
</style>
</head>

<body>
<div class="sidebar">
<h2>🚗 Admin</h2>
<a href="/admin/dashboard">Dashboard</a>
<a href="/admin/cars">Manage Cars</a>
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

<div class="activity">
<h3>Recent Customer Activity</h3>
<ul>
@foreach($recentActivities as $activity)
<li>{{ $activity }}</li>
@endforeach
</ul>
</div>
</div>

<script>
/* BOOKINGS CHART */
new Chart(document.getElementById("bookingChart"),{
type:"line",
data:{
labels: {!! json_encode($bookingMonths) !!},
datasets:[{label:"Monthly Bookings",data:{!! json_encode($bookingTotals) !!},borderColor:"#38bdf8",backgroundColor:"rgba(56,189,248,0.2)",tension:0.3}]
},
options:{responsive:true}
});

/* CUSTOMER CHART */
new Chart(document.getElementById("customerChart"),{
type:"bar",
data:{labels:{!! json_encode($months) !!},datasets:[{label:"Customer Growth",data:{!! json_encode($totals) !!},backgroundColor:"#22c55e"}]},
options:{responsive:true,plugins:{legend:{display:true},title:{display:true,text:"Monthly Customer Growth"}}}
});

/* REVENUE CHART */
new Chart(document.getElementById("revenueChart"),{
type:"doughnut",
data:{labels:["Cars","Customers"],datasets:[{data:[{{ $totalCars }},{{ $totalCustomers }}],backgroundColor:["#3b82f6","#22c55e","#f59e0b"]}]}
});
</script>
</body>
</html>