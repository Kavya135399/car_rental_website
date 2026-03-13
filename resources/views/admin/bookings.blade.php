<!DOCTYPE html>
<html>
<head>
<title>Bookings - Om Shanti Travels</title>

<style>

body{
    margin:0;
    font-family: Arial, Helvetica, sans-serif;
    background:#f4f6f9;
}

/* Header */

.header{
    background:#2c3e50;
    color:white;
    padding:20px;
    font-size:22px;
}

/* Container */

.container{
    padding:40px;
}

/* Table */

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

th, td{
    padding:15px;
    text-align:center;
}

th{
    background:#34495e;
    color:white;
}

tr:nth-child(even){
    background:#f2f2f2;
}

tr:hover{
    background:#ecf0f1;
}

/* Buttons */

.view-btn{
    padding:8px 14px;
    background:#3498db;
    color:white;
    text-decoration:none;
    border-radius:5px;
    transition:0.3s;
}

.view-btn:hover{
    background:#2980b9;
    transform:scale(1.05);
}

.delete-btn{
    padding:8px 14px;
    background:#e74c3c;
    color:white;
    text-decoration:none;
    border-radius:5px;
    transition:0.3s;
}

.delete-btn:hover{
    background:#c0392b;
    transform:scale(1.05);
}

</style>
</head>

<body>

<div class="header">
Om Shanti Travels - Booking Management
</div>

<div class="container">

<h2>Customer Bookings</h2>

<table>

<tr>
<th>ID</th>
<th>Customer Name</th>
<th>Car</th>
<th>Booking Date</th>
<th>Action</th>
</tr>

@foreach($bookings as $booking)

<tr>
<td>{{ $booking->id }}</td>
<td>{{ $booking->name }}</td>
<td>{{ $booking->car }}</td>
<td>{{ $booking->date }}</td>

<td>
<a href="#" class="view-btn">View</a>
<a href="/admin/bookings/delete/{{$booking->id}}" class="delete-btn">Delete</a>
</td>

</tr>

@endforeach

</table>

</div>

</body>
</html>