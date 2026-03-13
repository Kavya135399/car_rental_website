<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Carbook</title>
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
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
<li class="nav-item"><a href="{{ url('/about') }}" class="nav-link">About</a></li>
<li class="nav-item"><a href="{{ url('/cars') }}" class="nav-link">Cars</a></li>
<li class="nav-item"><a href="{{ url('/blog') }}" class="nav-link">Blog</a></li>
<li class="nav-item"><a href="{{ url('/contact') }}" class="nav-link">Contact</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- END nav -->
     
    
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('images/bg_3.jpg') }}');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
            <p class="breadcrumbs"><span class="mr-2"><a href="{{ url('/') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Cars <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Choose Your Car</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="car-wrap rounded ftco-animate">
              <div class="img rounded d-flex align-items-end" style="background-image: url('{{ asset('images/car-1.jpg') }}');">
              </div>
              <div class="text">
                <h2 class="mb-0"><a href="{{ url('car-single?id=1') }}">Range Rover</a></h2>
                <div class="d-flex mb-3">
                  <span class="cat">Cheverolet</span>
                  <p class="price ml-auto">$500 <span>/day</span></p>
                </div>
                <p class="d-flex mb-0 d-block"><a href="{{ url('/contact') }}" class="btn btn-primary py-2 mr-1">Contact Us</a>
              <a href="{{ url('car-single?id=1') }}" class="btn btn-secondary py-2 ml-1">Details</a></p>
              </div>
            </div>
          </div>

          <!-- Repeat the same for other cars, replacing image paths with asset() and links with url() -->
          <!-- Example for car-2 -->
          <div class="col-md-4">
            <div class="car-wrap rounded ftco-animate">
              <div class="img rounded d-flex align-items-end" style="background-image: url('{{ asset('images/car-2.jpg') }}');">
              </div>
              <div class="text">
                <h2 class="mb-0"><a href="{{ url('car-single?id=2') }}">Honda</a></h2>
                <div class="d-flex mb-3">
                  <span class="cat">Subaru</span>
                  <p class="price ml-auto">$500 <span>/day</span></p>
                </div>
                <p class="d-flex mb-0 d-block"><a href="{{ url('/contact') }}" class="btn btn-primary py-2 mr-1">Contact Us</a>
              <a href="{{ url('car-single?id=2') }}" class="btn btn-secondary py-2 ml-1">Details</a></p>
              </div>
            </div>
          </div>
<div class="col-md-4">
            <div class="car-wrap rounded ftco-animate">
              <div class="img rounded d-flex align-items-end" style="background-image: url('{{ asset('images/car-2.jpg') }}');">
              </div>
              <div class="text">
                <h2 class="mb-0"><a href="{{ url('car-single?id=3') }}">Crysta</a></h2>
                <div class="d-flex mb-3">
                  <span class="cat">Subaru</span>
                  <p class="price ml-auto">$500 <span>/day</span></p>
                </div>
                <p class="d-flex mb-0 d-block"><a href="{{ url('/contact') }}" class="btn btn-primary py-2 mr-1">Contact Us</a>
              <a href="{{ url('car-single?id=3') }}" class="btn btn-secondary py-2 ml-1">Details</a></p>
              </div>
            </div>
          </div>
<div class="col-md-4">
            <div class="car-wrap rounded ftco-animate">
              <div class="img rounded d-flex align-items-end" style="background-image: url('{{ asset('images/car-2.jpg') }}');">
              </div>
              <div class="text">
                <h2 class="mb-0"><a href="{{ url('car-single') }}">Range Rover</a></h2>
                <div class="d-flex mb-3">
                  <span class="cat">Subaru</span>
                  <p class="price ml-auto">$500 <span>/day</span></p>
                </div>
                <p class="d-flex mb-0 d-block"><a href="{{ url('/contact') }}" class="btn btn-primary py-2 mr-1">Contact Us</a>
              <a href="{{ url('car-single?id=4') }}" class="btn btn-secondary py-2 ml-1">Details</a></p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="car-wrap rounded ftco-animate">
              <div class="img rounded d-flex align-items-end" style="background-image: url('{{ asset('images/car-2.jpg') }}');">
              </div>
              <div class="text">
                <h2 class="mb-0"><a href="{{ url('car-single') }}">Range Rover</a></h2>
                <div class="d-flex mb-3">
                  <span class="cat">Subaru</span>
                  <p class="price ml-auto">$500 <span>/day</span></p>
                </div>
                <p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1">Contact Us </a> <a href="{{ url('car-single') }}" class="btn btn-secondary py-2 ml-1">Details</a></p>
              </div>
            </div>
          </div>
<div class="col-md-4">
            <div class="car-wrap rounded ftco-animate">
              <div class="img rounded d-flex align-items-end" style="background-image: url('{{ asset('images/car-2.jpg') }}');">
              </div>
              <div class="text">
                <h2 class="mb-0"><a href="{{ url('car-single') }}">Range Rover</a></h2>
                <div class="d-flex mb-3">
                  <span class="cat">Subaru</span>
                  <p class="price ml-auto">$500 <span>/day</span></p>
                </div>
                <p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1">Contact Us</a> <a href="{{ url('car-single') }}" class="btn btn-secondary py-2 ml-1">Details</a></p>
              </div>
            </div>
          </div>


          <!-- Repeat all remaining car divs similarly -->

        </div>
      </div>
    </section>

    

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

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="{{ asset('js/google-map.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    
  </body>
</html>