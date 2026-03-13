<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard - Om Shanti Travels</title>

<style>

body{
    margin:0;
    font-family:Arial, Helvetica, sans-serif;
    display:flex;
}

/* Sidebar */

.sidebar{
    width:250px;
    height:100vh;
    background:#2c3e50;
    color:white;
    padding-top:30px;
    position:fixed;
}

.sidebar h2{
    text-align:center;
    margin-bottom:40px;
}

.sidebar a{
    display:block;
    color:white;
    padding:15px 25px;
    text-decoration:none;
    transition:0.3s;
}

.sidebar a:hover{
    background:#34495e;
    padding-left:35px;
}

/* Main Content */

.main{
    margin-left:250px;
    padding:40px;
    width:100%;
    background:#f4f6f9;
    min-height:100vh;
}

.card-container{
    display:flex;
    gap:20px;
    margin-top:30px;
}

.card{
    background:white;
    padding:30px;
    border-radius:10px;
    width:200px;
    box-shadow:0 5px 20px rgba(0,0,0,0.1);
    text-align:center;
    transition:0.3s;
}

.card:hover{
    transform:translateY(-8px);
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
}

.logout-btn{
background:none;
border:none;
color:white;
font-size:16px;
cursor:pointer;
padding:10px;
}

</style>
</head>

<body>

<div class="sidebar">

<h2>Om Shanti Travels</h2>

<a href="/admin/dashboard">Dashboard</a>
<a href="/admin/cars">Manage Cars</a>
<a href="/admin/bookings">Customer</a>
<form method="POST" action="{{ route('admin.logout') }}">
@csrf
<button type="submit" class="logout-btn">
Logout
</button>
</form>

</div>

<div class="main">

<h1>Admin Dashboard</h1>
<p>Welcome to the Admin Panel</p>

<div class="card-container">

<div class="card">
<h3>Cars</h3>
<p>Manage rental cars</p>
</div>

<div class="card">
<h3>Customer</h3>
<p>View customer Contact Us</p>
</div>


</div>

</div>

</body>
</html>