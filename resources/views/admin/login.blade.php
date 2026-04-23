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
min-height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:#0f172a;
background-image:url("https://images.unsplash.com/photo-1503376780353-7e6692767b70");
background-size:cover;
background-position:center;
padding:16px;
/* Added for 3D effect context */
perspective: 1000px; 
overflow: hidden;
}

/* OVERLAY - Dark gradient overlay */
.overlay{
position:absolute;
width:100%;
height:100%;
background:linear-gradient(135deg, rgba(15,23,42,0.9), rgba(0,0,0,0.7));
top: 0;
left: 0;
}

/* TITLE */
.site-title{
position:absolute;
top:30px;
left:40px;
font-size:24px;
font-weight:600;
color:white;
z-index: 10;
text-shadow: 0 2px 10px rgba(0,0,0,0.5);
letter-spacing: 1px;
}

/* LOGIN CARD - Advanced Styling */
.login-box{
position:relative;
z-index: 2;
background:rgba(255,255,255,0.05);
backdrop-filter:blur(20px);
-webkit-backdrop-filter:blur(20px);
padding:50px 40px;
width:100%;
max-width:380px;
border-radius:24px;
border: 1px solid rgba(255,255,255,0.1);
box-shadow: 0 25px 50px rgba(0,0,0,0.5), 
            inset 0 0 20px rgba(255,255,255,0.05);
text-align:center;
color:white;

/* 3D Transform Setup */
transform-style: preserve-3d;
transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);

/* Floating Animation */
animation: float 6s ease-in-out infinite;
}

/* SHINE EFFECT */
.login-box::before {
content: '';
position: absolute;
top: 0;
left: -100%;
width: 100%;
height: 100%;
background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
transition: 0.5s;
pointer-events: none;
border-radius: 24px;
}

.login-box:hover::before {
left: 100%;
}

/* HOVER LIFT & TILT */
.login-box:hover {
transform: translateY(-10px) rotateX(5deg) rotateY(5deg);
box-shadow: 0 35px 60px rgba(0,0,0,0.6);
animation-play-state: paused; 
}

.login-box h2{
margin-bottom:30px;
font-weight:600;
font-size: 28px;
background: linear-gradient(to right, #fff, #94a3b8);
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
text-shadow: none;
}

/* INPUTS */
input{
width:100%;
padding:14px 20px;
margin:12px 0;
border-radius:50px;
border:1px solid rgba(255,255,255,0.15);
background:rgba(0,0,0,0.4);
color:white;
outline:none;
font-size: 15px;
transition: all 0.3s ease;
}

input::placeholder {
color: rgba(255,255,255,0.5);
}

input:focus{
border-color:#3b82f6;
background: rgba(0,0,0,0.6);
box-shadow: 0 0 20px rgba(59,130,246,0.3);
transform: scale(1.02);
}

/* BUTTON */
button{
width:100%;
padding:14px;
border:none;
background:linear-gradient(135deg, #22c55e, #16a34a);
color:white;
font-size:18px;
font-weight:600;
letter-spacing: 1px;
border-radius:50px;
cursor:pointer;
margin-top:20px;
transition:0.3s;
box-shadow: 0 10px 20px rgba(34,197,94,0.3);
position: relative;
overflow: hidden;
}

button:hover{
transform: translateY(-3px);
box-shadow: 0 15px 30px rgba(34,197,94,0.5);
}

/* LINK */
a{
color:#93c5fd;
text-decoration:none;
font-size:14px;
transition: 0.3s;
display: inline-block;
margin-top: 5px;
}

a:hover{
color: #ffffff;
transform: translateY(-2px);
}

/* FLOATING KEYFRAMES */
@keyframes float {
0%, 100% { transform: translateY(0px); }
50% { transform: translateY(-15px); }
}

/* RESPONSIVE */
@media (max-width: 480px){
body{
align-items:flex-start;
padding-top:40px;
perspective: none; /* Disable 3D on mobile */
}
.site-title{
position:static;
margin-bottom:20px;
text-align:center;
width: 100%;
left: 0;
}
.login-box{
padding:30px 25px;
border-radius: 20px;
animation: none; /* Disable float on mobile */
transform: none !important;
box-shadow: 0 15px 30px rgba(0,0,0,0.5);
}
.login-box:hover {
transform: none;
}
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
<div style="margin-top:15px;">
<a href="/forgot-password">Forgot Password?</a>
</div>
</form>

</div>

</body>
</html>