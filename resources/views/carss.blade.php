<h2>Available Cars</h2>

<div style="display:flex; gap:20px; flex-wrap:wrap;">
@foreach($cars as $car)
    <div style="border:1px solid #ccc; padding:10px; width:250px;">
        
        @if($car->image)
            <img src="{{ asset('storage/' . $car->image) }}" width="100%">
        @endif

        <h3>{{ $car->name }}</h3>
        <p>{{ $car->brand }}</p>

        <button>Book Now</button>
    </div>
@endforeach
</div>