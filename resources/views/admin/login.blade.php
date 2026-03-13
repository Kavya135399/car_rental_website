<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>

<style>

body{
    margin:0;
    padding:0;
    font-family: Arial, Helvetica, sans-serif;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background: linear-gradient(135deg,#4facfe,#00f2fe);
}

.login-box{
    background:white;
    padding:40px;
    width:320px;
    border-radius:10px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
    text-align:center;
    transition:0.3s;
}

.login-box:hover{
    transform:translateY(-5px);
    box-shadow:0 15px 35px rgba(0,0,0,0.3);
}

h2{
    margin-bottom:25px;
}

input{
    width:100%;
    padding:12px;
    margin:10px 0;
    border-radius:6px;
    border:1px solid #ccc;
    outline:none;
    transition:0.3s;
}

input:focus{
    border-color:#4facfe;
    box-shadow:0 0 5px rgba(79,172,254,0.5);
}

button{
    width:100%;
    padding:12px;
    border:none;
    background:#4facfe;
    color:white;
    font-size:16px;
    border-radius:6px;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#00c6ff;
    transform:scale(1.05);
}

</style>
</head>

<body>

<div class="login-box">

<form method="post" action="/admin/login">
@csrf

<h2>Admin Login</h2>

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit">Login</button>

</form>

</div>

</body>
</html>