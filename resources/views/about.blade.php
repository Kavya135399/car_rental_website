<!DOCTYPE html>
<html lang="en">
<head>
<title>Carbook</title>
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
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
<div class="container">

<a class="navbar-brand" href="{{ url('/') }}">Car<span>Book</span></a>

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
style="background-image: url('{{ asset('images/bg_3.jpg') }}');">

<div class="overlay"></div>

<div class="container">

<div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">

<div class="col-md-9 ftco-animate pb-5">

<p class="breadcrumbs">
<span class="mr-2"><a href="{{ url('/') }}">Home <i class="ion-ios-arrow-forward"></i></a></span>
<span>About <i class="ion-ios-arrow-forward"></i></span>
</p>

<h1 class="mb-3 bread">About Us</h1>

</div>

</div>
</div>

</section>


<!-- ABOUT SECTION -->
<section class="ftco-section ftco-about">

<div class="container">

<div class="row no-gutters">

<div class="col-md-6 p-md-5 img img-2"
style="background-image: url('{{ asset('images/about.jpg') }}');">
</div>

<div class="col-md-6 wrap-about ftco-animate">

<h2 class="mb-4">Welcome to Carbook</h2>

<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>

<p>On her way she met a copy. The copy warned the Little Blind Text.</p>

<a href="#" class="btn btn-primary py-3 px-4">Search Vehicle</a>

</div>

</div>

</div>

</section>


<!-- FOOTER -->
<footer class="text-center mt-5">
<p>Copyright © {{ date('Y') }}</p>
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