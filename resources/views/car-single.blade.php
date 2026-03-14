<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Om shanti Travels</title>
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

    <!-- Navbar -->
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
            <!-- <li class="nav-item"><a href="{{ url('/services') }}" class="nav-link">Services</a></li> -->
            <!-- <li class="nav-item"><a href="{{ url('/pricing') }}" class="nav-link">Pricing</a></li> -->
            <li class="nav-item"><a href="{{ url('/cars') }}" class="nav-link">Cars</a></li>
            <li class="nav-item"><a href="{{ url('/blog') }}" class="nav-link">Blog</a></li>
            <li class="nav-item"><a href="{{ url('/contact') }}" class="nav-link">Contact</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- END Navbar -->

    <!-- Hero Section -->
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('images/' . $car['image']) }}');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
            <p class="breadcrumbs">
              <span class="mr-2"><a href="{{ url('/') }}">Home <i class="ion-ios-arrow-forward"></i></a></span>
              <span><a href="{{ url('/cars') }}">Cars <i class="ion-ios-arrow-forward"></i></a></span>
              <span>{{ $car['name'] }} <i class="ion-ios-arrow-forward"></i></span>
            </p>
            <h1 class="mb-3 bread">{{ $car['name'] }}</h1>
          </div>
        </div>
      </div>
    </section>

    <!-- Modern Car Details Section -->
    <section class="ftco-section bg-light">
      <div class="container">
        <div class="row justify-content-center">

          <div class="col-md-10">
            <div class="card shadow-lg border-0 p-4" style="border-radius:15px;">

              <div class="row align-items-center">

                <!-- Car Image -->
                <div class="col-md-6">
                  <img src="{{ asset('images/' . $car['image']) }}" class="img-fluid rounded shadow">
                </div>

                <!-- Car Info -->
                <div class="col-md-6">

                  <span class="badge badge-primary mb-2">{{ $car['brand'] }}</span>

                  <h2 class="mb-3 font-weight-bold">{{ $car['name'] }}</h2>

                  

                  <div class="row text-center mb-4">

                    <div class="col-4">
                      <i class="ion-ios-people" style="font-size:28px;color:#f96d00;"></i>
                      <p class="mt-2">{{ $car['seats'] }} Seats</p>
                    </div>

                    <div class="col-4">
                      <i class="ion-ios-speedometer" style="font-size:28px;color:#f96d00;"></i>
                      <p class="mt-2">{{ $car['transmission'] }}</p>
                    </div>

                    <div class="col-4">
                      <i class="ion-ios-flame" style="font-size:28px;color:#f96d00;"></i>
                      <p class="mt-2">{{ $car['fuel_type'] }}</p>
                    </div>

                  </div>

                  <hr>

                  <p>{{ $car['description'] }}</p>

                  <p>
                    <strong>Driver:</strong>
                    @if($car['driver'])
                      <span class="text-success">Available</span>
                    @else
                      <span class="text-danger">Not Available</span>
                    @endif
                  </p>

                  <div class="mt-4">
                    <a href="{{ url('/cars') }}" class="btn btn-secondary mr-2">Back to Cars</a>
                    <a href="{{ url('/contact') }}" class="btn btn-primary">Contact Us</a>
                  </div>

                </div>

              </div>

            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="ftco-footer ftco-bg-dark ftco-section">
  <div class="container">
    <div class="row mb-5">

      <!-- Company Info -->
      <div class="col-md">
        <div class="ftco-footer-widget mb-4">
          <h2 class="ftco-heading-2">
            OM SHANTI <span style="color:#01d28e;">TRAVELS</span>
          </h2>
          <p>
            We provide the best car rental services for comfortable and safe travel.
            Book your ride today and enjoy a smooth journey with Om Shanti Travels.
          </p>
          <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
            <!-- <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li> -->
            <!-- <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li> -->
            <!-- <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li> -->
          </ul>
        </div>
      </div>

      <!-- Information -->
      <div class="col-md">
        <div class="ftco-footer-widget mb-4 ml-md-5">
          <h2 class="ftco-heading-2">Information</h2>
          <ul class="list-unstyled">
            <li><a href="{{ url('/about') }}" class="py-2 d-block">About</a></li>
            <!-- <li><a href="{{ url('/services') }}" class="py-2 d-block">Services</a></li> -->
            <li><a href="{{ url('/blog') }}" class="py-2 d-block">Blog</a></li>
            <li><a href="{{ url('/cars') }}" class="py-2 d-block">Cars</a></li>
          </ul>
        </div>
      </div>

      <!-- Customer Support -->
      <div class="col-md">
        <div class="ftco-footer-widget mb-4">
          <h2 class="ftco-heading-2">Customer Support</h2>
          <ul class="list-unstyled">
            <!-- <li><a href="#" class="py-2 d-block">FAQ</a></li> -->
            <!-- <li><a href="#" class="py-2 d-block">Payment Option</a></li> -->
            <li><a href="#" class="py-2 d-block">Booking Tips</a></li>
            <!-- <li><a href="#" class="py-2 d-block">How it works</a></li> -->
            <li><a href="{{ url('/contact') }}" class="py-2 d-block">Contact Us</a></li>
          </ul>
        </div>
      </div>

      <!-- Contact Info -->
      <div class="col-md">
        <div class="ftco-footer-widget mb-4">
          <h2 class="ftco-heading-2">Have a Questions?</h2>
          <div class="block-23 mb-3">
            <ul>
              <li>
                <span class="icon icon-map-marker"></span>
                <span class="text">602,Floor No. 6, The 132 Complex, Nr.Indraprasth Saptak,Nr.AEC Flyover,Naranpura, Ahmedabad, Gujarat-380013</span>
              </li>
              <li>
                <a href="#">
                  <span class="icon icon-phone"></span>
                  <span class="text">+91 99090 35336</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <span class="icon icon-envelope"></span>
                  <span class="text">omshanti.amd@gmail.com</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>

    </div>

    

  </div>
</footer>
    <!-- Loader -->
    <div id="ftco-loader" class="show fullscreen">
      <svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"/>
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"/>
      </svg>
    </div>

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
