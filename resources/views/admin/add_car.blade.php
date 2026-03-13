<!DOCTYPE html>
<html>
<head>
<title>Add Car - Om Shanti Travels</title>

<style>

body{
    margin:0;
    font-family: Arial, Helvetica, sans-serif;
    background: linear-gradient(135deg,#4facfe,#00f2fe);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

/* Form Card */

.form-box{
    background:white;
    padding:40px;
    width:350px;
    border-radius:10px;
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
    text-align:center;
    transition:0.3s;
}

.form-box:hover{
    transform:translateY(-5px);
}

/* Title */

h2{
    margin-bottom:25px;
}

/* Inputs */

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
    box-shadow:0 0 6px rgba(79,172,254,0.6);
}

/* Button */

button{
    width:100%;
    padding:12px;
    border:none;
    background:#4facfe;
    color:white;
    font-size:16px;
    border-radius:6px;
    cursor:pointer;
    margin-top:10px;
    transition:0.3s;
}

button:hover{
    background:#00c6ff;
    transform:scale(1.05);
}

/* Header */

.header{
    position:absolute;
    top:20px;
    left:30px;
    font-size:22px;
    color:white;
    font-weight:bold;
}

</style>

</head>

<body>

<div class="header">Om Shanti Travels - Admin Panel</div>

<div class="form-box">

<h2>Add New Car</h2>

<form method="post" action="/admin/cars/save">
@csrf

<input type="text" name="name" placeholder="Car Name" required>

<input type="text" name="price" placeholder="Price (₹)" required>

<input type="text" name="image" placeholder="Image URL">

<button type="submit">Save Car</button>

</form>

</div>

</body>
</html>