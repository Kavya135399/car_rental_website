<!DOCTYPE html>
<html>
<head>
<title>Manage Cars - Om Shanti Travels</title>

<style>

body{
    font-family: Arial, Helvetica, sans-serif;
    background:#f4f6f9;
    margin:0;
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

/* Add Button */

.add-btn{
    display:inline-block;
    margin-bottom:20px;
    padding:12px 20px;
    background:#27ae60;
    color:white;
    text-decoration:none;
    border-radius:6px;
    transition:0.3s;
}

.add-btn:hover{
    background:#1e8449;
    transform:scale(1.05);
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

/* Delete Button */

.delete-btn{
    padding:8px 15px;
    background:#e74c3c;
    color:white;
    text-decoration:none;
    border-radius:5px;
    transition:0.3s;
}

.delete-btn:hover{
    background:#c0392b;
    transform:scale(1.1);
}

</style>

</head>

<body>

<div class="header">
Om Shanti Travels - Manage Cars
</div>

<div class="container">

<h2>Cars List</h2>

<a href="/admin/cars/add" class="add-btn">+ Add Car</a>

<table>

<tr>
<th>ID</th>
<th>Car Name</th>
<th>Price</th>
<th>Action</th>
</tr>

@foreach($cars as $car)

<tr>
<td>{{ $car->id }}</td>
<td>{{ $car->name }}</td>
<td>₹{{ $car->price }}</td>

<td>
<a href="/admin/cars/delete/{{$car->id}}" class="delete-btn">Delete</a>
</td>

</tr>

@endforeach

</table>

</div>

</body>
</html>