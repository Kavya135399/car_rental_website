<!DOCTYPE html>
<html>
<head>
<title>Contact Messages - Om Shanti Travels</title>

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

/* BUTTONS */

.reply-btn{
background:#22c55e;
padding:6px 12px;
border-radius:5px;
color:white;
text-decoration:none;
margin-right:5px;
}

.delete-btn{
background:#ef4444;
padding:6px 12px;
border-radius:5px;
color:white;
text-decoration:none;
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

</body>
</html>