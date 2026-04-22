<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Om Shanti Travels</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Om Shanti<span> Travels</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav">
          <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="{{ url('/about') }}" class="nav-link">About</a></li>
            <li class="nav-item active"><a href="{{ url('/cars') }}" class="nav-link">Cars</a></li>
            <!-- <li class="nav-item"><a href="{{ url('/booking') }}" class="nav-link">Booking</a></li> -->
            <li class="nav-item"><a href="{{ url('/blog') }}" class="nav-link">Blog</a></li>
            <li class="nav-item"><a href="{{ url('/contact') }}" class="nav-link">Contact</a></li>
          </ul>
        </div>
      </div>
    </nav>

    @php
      $img = null;
      if ($car->image) {
        $img = \Illuminate\Support\Str::startsWith($car->image, ['cars_uploads/', 'cars/', 'public/'])
          ? asset('storage/' . $car->image)
          : asset('images/' . $car->image);
      } else {
        $img = asset('images/car-10.jpg');
      }
      $bookingUrl = url('booking?car_id=' . $car->id . '&car=' . urlencode($car->name) . '&price=' . urlencode($car->price_per_day ?? 0) . '&seats=' . urlencode($car->seats ?? 0));
    @endphp

    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ $img }}');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
            <p class="breadcrumbs">
              <span class="mr-2"><a href="{{ url('/') }}">Home <i class="ion-ios-arrow-forward"></i></a></span>
              <span><a href="{{ url('/cars') }}">Cars <i class="ion-ios-arrow-forward"></i></a></span>
              <span>{{ $car->name }} <i class="ion-ios-arrow-forward"></i></span>
            </p>
            <h1 class="mb-3 bread">{{ $car->name }}</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <div class="car-wrap rounded ftco-animate" style="padding:16px;">
              <img src="{{ $img }}" alt="Car" style="width:100%;border-radius:12px;">
            </div>
          </div>
          <div class="col-md-5">
            <div class="car-wrap rounded ftco-animate" style="padding:22px;">
              <h2 class="mb-2">{{ $car->name }}</h2>
              <div class="d-flex mb-3">
                <span class="cat">{{ $car->brand }}</span>
                @if(!is_null($car->price_per_day))
                  <p class="price ml-auto">₹{{ number_format($car->price_per_day) }} <span>/day</span></p>
                @endif
              </div>
              <ul style="padding-left:18px;color:#555;">
                <li>Seats: {{ $car->seats ?? '—' }}</li>
                <li>Fuel: {{ $car->fuel_type ?? '—' }}</li>
                <li>Transmission: {{ $car->transmission ?? '—' }}</li>
              </ul>
              @if(!empty($car->description))
                <p style="margin-top:10px;color:#666;">{{ $car->description }}</p>
              @endif
              <div style="margin-top:18px;">
                <a href="{{ $bookingUrl }}" class="btn btn-primary py-2 mr-1">Book Now</a>
                <a href="{{ url('/cars') }}" class="btn btn-secondary py-2 ml-1">Back</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('js/scrollax.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
  </body>
</html>
