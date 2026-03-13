<!DOCTYPE html>
<html lang="en">
<head>
<title>Om Shanti Travels</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

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
<link rel="stylesheet" href="{{ asset('css/about.css') }}">

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
<div class="container">

<a class="navbar-brand" href="{{ url('/') }}">om shanti<span>travels</span></a>

<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav">
<span class="oi oi-menu"></span> Menu
</button>

<div class="collapse navbar-collapse" id="ftco-nav">

<ul class="navbar-nav ml-auto">

<li class="nav-item">
<a href="{{ url('/') }}" class="nav-link">Home</a>
</li>

<li class="nav-item active">
<a href="{{ url('/about') }}" class="nav-link">About</a>
</li>


<li class="nav-item">
<a href="{{ url('/cars') }}" class="nav-link">Cars</a>
</li>

<li class="nav-item">
<a href="{{ url('/blog') }}" class="nav-link">Blog</a>
</li>

<li class="nav-item">
<a href="{{ url('/contact') }}" class="nav-link">Contact</a>
</li>

</ul>

</div>
</div>
</nav>


<!-- HERO SECTION -->
<section class="hero-wrap hero-wrap-2 js-fullheight"
style="background-image: url('{{ asset('images/about2.jpg') }}');">

<div class="overlay"></div>

<div class="container">

<div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">

<div class="col-md-9 ftco-animate pb-5">

<p class="breadcrumbs">
<!-- <span class="mr-2"><a href="{{ url('/') }}">Home <i class="ion-ios-arrow-forward"></i></a></span>
<span>About <i class="ion-ios-arrow-forward"></i></span> -->
<h1>Hire a professional chauffeur service that serves Pan India</h1>
<p>Om Shanti Travels is a leading provider of professional chauffeur services in India.
    With years of experience in the industry, we have become a trusted and reliable partner for individuals and businesses seeking luxury ground transportation Pan India.</p>
</p>
<button class="contact-btn">Contact Now</button>

<!-- <h1 class="mb-3 bread">About Us</h1> -->

</div>

</div>
</div>

</section>


<!-- ABOUT SECTION -->
<section class="ftco-section ftco-about">
<div class="container">
<div class="row no-gutters">
<div class="col-md-6 p-md-5 img img-2"
style="background-image: url('{{ asset('images/houly2.jpg') }}');">
</div>

<div class="col-md-6 wrap-about ftco-animate">
<!-- <div> -->
<h1>Hourly Services</h1>

<p class="p-text">Travel on your schedule with our flexible hourly chauffeur service—ideal for meetings, events, or exploring the city in comfort and style.</p>
<p class="p-text">Your time, your ride—book a chauffeur by the hour and travel with ease and elegance.</p>
<!-- <a href="#" class="btn btn-primary py-3 px-4">Search Vehicle</a> -->
<!-- <button class="serach-vehical">Contact Now</button> -->
</div>
</div>
</div>
</section>

<!-- SECOND ABOUT SECTION -->
<section class="ftco-section ftco-about about-reverse">

<div class="container">
<div class="row no-gutters">

<!-- LEFT SIDE TEXT -->
<div class="col-md-6 wrap-about ftco-animate text-side">

<h1>Airport Transfer</h1>

<p class="p-text">
Enjoy smooth and reliable airport transfers with our professional chauffeurs.
We ensure timely pickups and comfortable rides to and from the airport.
</p>

<p class="p-text">
Start or end your journey stress-free with Om Shanti Travels' trusted airport transportation service.
</p>

</div>

<!-- RIGHT SIDE IMAGE -->
<div class="col-md-6 p-md-5 img img-2"
style="background-image: url('{{ asset('images/houly2.jpg') }}');">
</div>

</div>
</div>

</section>


<!-- FOOTER -->
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


<!-- JS -->
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