
<!DOCTYPE html>
<html>
<head>
<title>Manage Cars - Om Shanti Travels</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
display:flex;
background:#0f172a;
color:white;
}

/* SIDEBAR */

.sidebar{
width:220px;
height:100vh;
background:#020617;
padding:25px;
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

/* MAIN CONTENT */

.main{
margin-left:220px;
width:100%;
padding:40px;
}

/* HEADER */

.header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:30px;
}

.header h1{
font-weight:500;
}

/* ADD BUTTON */

.add-btn{
padding:10px 18px;
background:#22c55e;
color:white;
text-decoration:none;
border-radius:6px;
transition:0.3s;
}

.add-btn:hover{
background:#16a34a;
transform:scale(1.05);
}

/* TABLE */

.table-box{
background:#020617;
padding:25px;
border-radius:12px;
box-shadow:0 10px 25px rgba(0,0,0,0.5);
}

table{
width:100%;
border-collapse:collapse;
}

th,td{
padding:14px;
text-align:center;
}

th{
background:#1e293b;
}

tr{
border-bottom:1px solid #1e293b;
}

tr:hover{
background:#1e293b;
}

/* DELETE BUTTON */

.delete-btn{
background:#ef4444;
padding:6px 12px;
border-radius:5px;
text-decoration:none;
color:white;
transition:0.3s;
}

.delete-btn:hover{
background:#dc2626;
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

<!-- MAIN CONTENT -->

<div class="main">

<div class="header">
<h1>Manage Cars</h1>

<a href="/admin/cars/add" class="add-btn">+ Add Car</a>
</div>

<div class="table-box">

<table>

<tr>
<th>ID</th>
<th>Car Name</th>
<th>Brand</th>
<th>Image</th>
<th>Action</th>
</tr>

@foreach($cars as $car)

<tr>

<td>{{ $car->id }}</td>
<td>{{ $car->name }}</td>
<td>{{ $car->brand }}</td>

<td>
<img src="/images/{{$car->image}}" width="80">
</td>



<td>

<a href="/admin/cars/edit/{{$car->id}}" 
style="background:#3b82f6;padding:6px 12px;border-radius:5px;color:white;text-decoration:none;">
Edit
</a>

<a href="/admin/cars/delete/{{$car->id}}" class="delete-btn">
Delete
</a>

</td>
</tr>

@endforeach

</table>

</div>

</div>

</body>
</html>