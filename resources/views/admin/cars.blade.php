
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
<a href="/admin/rentals">Bookings</a>
<a href="/admin/drivers">Drivers</a>
<a href="/admin/bookings">Customers</a>
<a href="/admin/logout">Logout</a>
</div>

<!-- MAIN CONTENT -->

<div class="main">

<div class="header">
<h1>Manage Cars</h1>

<a href="/admin/cars/add" class="add-btn">+ Add Car</a>
</div>

<div class="table-box">
@if(session('success'))
<div style="background:rgba(34,197,94,.15);border:1px solid rgba(34,197,94,.35);padding:12px;border-radius:10px;margin-bottom:14px;color:#bbf7d0;">
{{ session('success') }}
</div>
@endif

<table>

<tr>
<th>ID</th>
<th>Car Name</th>
<th>Brand</th>
<th>Price/Day</th>
<th>Units</th>
<th>Image</th>
<th>Action</th>
</tr>

@foreach($cars as $car)

<tr>

<td>{{ $car->id }}</td>
<td>{{ $car->name }}</td>
<td>{{ $car->brand }}</td>
<td>
@if(!is_null($car->price_per_day))
₹{{ number_format($car->price_per_day) }}
@else
—
@endif
</td>
<td>{{ $car->units_total ?? 0 }}</td>

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
  <img src="{{ $img }}" width="80" style="border-radius:8px;border:1px solid #1e293b;">
@else
  <span style="color:#94a3b8;">No image</span>
@endif
</td>



<td>

<a href="/admin/cars/edit/{{$car->id}}" 
style="background:#3b82f6;padding:6px 12px;border-radius:5px;color:white;text-decoration:none;">
Edit
</a>

<a href="/admin/cars/{{$car->id}}/units"
style="background:#f59e0b;padding:6px 12px;border-radius:5px;color:#0f172a;text-decoration:none;margin-left:6px;font-weight:600;">
Units
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
