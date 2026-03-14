<!DOCTYPE html>
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
<input type="text" name="image" value="{{$car->image}}">
<br><br>

<button type="submit">Update Car</button>

</form>

</body>
</html>