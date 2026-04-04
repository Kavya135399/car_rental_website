<h2>Add Car</h2>

@if(session('success'))
<p style="color:green">{{ session('success') }}</p>
@endif

<form method="POST" action="/admin/add-carss" enctype="multipart/form-data">
    @csrf

    <input type="text" name="name" placeholder="Car Name" required><br><br>
    <input type="text" name="brand" placeholder="Brand" required><br><br>
    <input type="file" name="image"><br><br>

    <button type="submit">Add Car</button>
</form>