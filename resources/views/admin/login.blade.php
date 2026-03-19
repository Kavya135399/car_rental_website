<!DOCTYPE html>
<html>
<head>
<title>Admin Login - Om Shanti Travels</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}


body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:#0f172a;
background-image:url("https://images.unsplash.com/photo-1503376780353-7e6692767b70");
background-size:cover;
background-position:center;
}

/* overlay */

.overlay{
position:absolute;
width:100%;
height:100%;
background:rgba(0,0,0,0.7);
}

/* login card */

.login-box{
position:relative;
background:rgba(2,6,23,0.9);
padding:40px;
width:350px;
border-radius:12px;
box-shadow:0 15px 40px rgba(0,0,0,0.6);
text-align:center;
color:white;
backdrop-filter:blur(10px);
}

.login-box h2{
margin-bottom:25px;
font-weight:500;
}

/* inputs */

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

/* button */

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
transform:scale(1.05);
}

/* title */

.site-title{
position:absolute;
top:30px;
left:40px;
font-size:22px;
font-weight:600;
color:white;
}

</style>
</head>

<body>

<div class="overlay"></div>

<div class="site-title">🚗 Om Shanti Travels</div>

<div class="login-box">

<form method="post" action="/admin/login">
@csrf

<h2>Admin Login</h2>

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit">Login</button>
<div style="margin-top:10px;">
<a href="/forgot-password">Forgot Password?</a>
</div>
</form>

</div>

</body>
</html>