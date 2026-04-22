<!DOCTYPE html>
<html>
<head>
<title>Add Car - Om Shanti Travels</title>

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

/* MAIN */

.main{
margin-left:220px;
width:100%;
padding:40px;
}

/* FORM CARD */

.form-box{
background:#020617;
padding:35px;
width:400px;
border-radius:12px;
box-shadow:0 10px 25px rgba(0,0,0,0.5);
}

.form-box h2{
margin-bottom:20px;
font-weight:500;
}

/* INPUTS */

input{
width:100%;
padding:12px;
margin:10px 0;
border-radius:6px;
border:1px solid #1e293b;
background:#0f172a;
color:white;
outline:none;
}

input:focus{
border-color:#3b82f6;
}

/* BUTTON */

button{
width:100%;
padding:12px;
border:none;
background:#22c55e;
color:white;
font-size:16px;
border-radius:6px;
cursor:pointer;
margin-top:10px;
transition:0.3s;
}

button:hover{
background:#16a34a;
transform:scale(1.03);
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

<!-- MAIN -->

<div class="main">

<div class="form-box">

<h2>Add New Car</h2>

<!-- <form method="post" action="/admin/cars/save">
@csrf

<input type="text" name="name" placeholder="Car Name">

<input type="text" name="brand" placeholder="Car Brand">
<input type="text" name="image" placeholder="Image">

<button type="submit">Save Car</button>

</form> -->


<form method="POST" action="/admin/cars/save" enctype="multipart/form-data">
    @csrf

    <input type="text" name="name" placeholder="Car Name" required><br><br>
    <input type="text" name="brand" placeholder="Brand" required><br><br>
    <input type="number" name="price_per_day" placeholder="Price per day (₹)" step="1"><br><br>
    <input type="number" name="seats" placeholder="Seats (e.g. 4, 6)" min="1"><br><br>
    <input type="text" name="fuel_type" placeholder="Fuel Type (Petrol/Diesel/Hybrid)"><br><br>
    <input type="text" name="transmission" placeholder="Transmission (Manual/Automatic)"><br><br>
    <label style="color:#cbd5f5;font-size:14px;display:block;margin-top:6px;">
      <input type="checkbox" name="featured" value="1" style="width:auto;margin-right:6px;"> Featured
    </label>
    <textarea name="description" placeholder="Description" style="width:100%;padding:12px;margin:10px 0;border-radius:6px;border:1px solid #1e293b;background:#0f172a;color:white;outline:none;min-height:90px;"></textarea>
    <input type="file" name="image"><br><br>

    <button type="submit">Save Car</button>
</form>
</div>

</div>

</body>
</html>
