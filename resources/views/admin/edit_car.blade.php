<!-- <!DOCTYPE html>
<html>

<head>
    <title>Edit Car</title>
</head>

<body>

    <h2>Edit Car</h2>

    <form method="POST" action="/admin/cars/update/{{$car->id}}">
        @csrf

        <label>Car Name</label>
        <br>
        <input type="text" name="name" value="{{$car->name}}">
        <br><br>

        <label>Brand</label>
        <br>
        <input type="text" name="brand" value="{{$car->brand}}">
        <br><br>

        <label>Image</label>
        <br>
        <input type="file" name="image" value="{{$car->image}}">
        <br><br>

        <button type="submit">Update Car</button>

    </form>

</body>

</html> -->

<!DOCTYPE html>
<html>
<head>
<title>Edit Car - Om Shanti Travels</title>

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

/* Sidebar */
.sidebar{
width:220px;
height:100vh;
background:#020617;
padding:20px;
position: fixed;
}

.sidebar h2{
margin-bottom:40px;
}

.sidebar a{
display:block;
color:#94a3b8;
padding: 12px;
margin-bottom: 10px;
text-decoration:none;
border-radius: 6px;
transition: 0.3s;
/* margin:15px 0; */
}

.sidebar a:hover{
background:#1e293b;
}

/* Main */
.main{
/* flex:1;
display:flex;
justify-content:center;
align-items:center;
height:100vh; */
margin-left:220px;
width:100%;
padding:40px;
}

/* Card */
.card{
background:#020617;
padding:35px;
border-radius:12px;
width:420px;
/* box-shadow:0 15px 40px rgba(0,0,0,0.6);
 */
box-shadow:0 10px 25px rgba(0,0,0,0.5);
}

.card h2{
margin-bottom:20px;
text-align:center;
font-weight:500;

}

/* Inputs */
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
/* outline:none; */
}

/* Button */
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
@if($car->image)
    <img src="{{ asset('images/'.$car->image) }}" width="100" style="margin-bottom:10px;">
@endif
<!-- Sidebar -->
<div class="sidebar">
    <h2>🚗 Admin</h2>
    <a href="/admin/dashboard">Dashboard</a>
    <a href="/admin/cars">Manage Cars</a>
    <a href="/admin/bookings">Customers</a>
    <a href="/admin/logout">Logout</a>
</div>

<!-- Main -->
<div class="main">

<div class="card">

<h2>Edit Car</h2>

<form method="POST" action="/admin/cars/update/{{$car->id}}" enctype="multipart/form-data">
    @csrf

    <input type="text" name="name" value="{{$car->name}}" placeholder="Car Name" required>

    <input type="text" name="brand" value="{{$car->brand}}" placeholder="Brand" required>

        <!-- <input type="file" name="image" value="{{$car->image}}"> -->
<input type="file" name="image">
    <button type="submit">Update Car</button>

</form>

</div>

</div>

</body>
</html>