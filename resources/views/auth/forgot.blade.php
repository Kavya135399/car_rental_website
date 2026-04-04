<!DOCTYPE html>
<html>
<head>
<title>Forgot Password - Om Shanti Travels</title>

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
background:#0f172a; /* ❌ no image */
}

/* card */
.login-box{
background:rgba(2,6,23,0.9);
padding:40px;
width:350px;
border-radius:12px;
box-shadow:0 15px 40px rgba(0,0,0,0.6);
text-align:center;
color:white;
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

.login-box h2{
margin-bottom:20px;
font-weight:500;
}

/* messages */
.success{
color:#22c55e;
margin-bottom:10px;
}

.error{
color:#ef4444;
margin-bottom:10px;
}

/* input */
input{
width:100%;
padding:12px;
margin:10px 0;
border-radius:6px;
border:1px solid #1e293b;
background:#020617;
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

a{
color:#3b82f6;
text-decoration:none;
}

</style>
</head>

<body>

<div class="site-title">🚗 Om Shanti Travels</div>

<div class="login-box">

<h2>Forgot Password</h2>
@if ($errors->any())
    <div class="error">
        {{ $errors->first() }}
    </div>
@endif
@if(session('success'))
    <p class="success">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p class="error">{{ session('error') }}</p>
@endif

<form method="POST" action="{{ url('/send-otp') }}">
    @csrf

    <input type="email" name="email" placeholder="Enter Email" required>

    <button type="submit">Send OTP</button>

    <div style="margin-top:10px;">
        <a href="/admin">Back to Login</a>
    </div>

</form>

</div>

</body>
</html>