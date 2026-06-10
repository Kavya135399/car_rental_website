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

<!-- Custom Styles for Attractive Form -->
<style>
    /* New Contact Form Style - Dark Transparent/Grey */
    .modern-contact-form {
        background: rgba(0, 0, 0, 0.85); /* Dark transparent background */
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .modern-contact-form h2 {
        color: #ffffff;
        font-weight: 700;
        margin-bottom: 20px;
        border-bottom: 2px solid #f81c1c;
        display: inline-block;
        padding-bottom: 10px;
    }

    .modern-contact-form .label {
        color: #e0e0e0; /* Light grey text for labels */
        font-weight: 500;
    }

    .modern-contact-form .form-control {
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid transparent;
        border-radius: 5px;
        color: #333;
        padding: 12px;
        transition: all 0.3s ease;
    }

    .modern-contact-form .form-control:focus {
        background: #ffffff;
        border-color: #f81c1c; /* Red focus border matching logo */
        box-shadow: 0 0 0 3px rgba(248, 28, 28, 0.2);
    }

    .modern-contact-form .btn-secondary {
        background: #f81c1c; /* Brand Red Button */
        border: none;
        padding: 12px 20px;
        font-weight: 600;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        border-radius: 5px;
    }

    .modern-contact-form .btn-secondary:hover {
        background: #d31515;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(248, 28, 28, 0.4);
    }

    /* Enhancing the right side text section */
    .services-wrap {
        background: #fff;
        padding: 40px;
        border-radius: 0 10px 10px 0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }
    
    /* Hero text shadow for better readability */
    .hero-wrap h1, .hero-wrap p {
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }
</style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light">
<div class="container">

<a class="navbar-brand" href="{{ url('/') }}"><img class="navbar-brand-icon" src="{{ asset('images/om-shanti-mark.png') }}" alt="">Om Shanti <span style="color: #f81c1c;">Travels</span></a>

<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav">
<span class="oi oi-menu"></span> Menu
</button>

<div class="collapse navbar-collapse" id="ftco-nav">

<ul class="navbar-nav ml-auto">

<li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
<li class="nav-item"><a href="{{ url('/about') }}" class="nav-link">About</a></li>
<li class="nav-item"><a href="{{ url('/cars') }}" class="nav-link">Cars</a></li>
<!-- <li class="nav-item"><a href="{{ url('/booking/status') }}" class="nav-link">Status</a></li> -->
<!-- <li class="nav-item"><a href="{{ url('/booking') }}" class="nav-link">Booking</a></li> -->
<li class="nav-item"><a href="{{ url('/blog') }}" class="nav-link">Blog</a></li>
<li class="nav-item"><a href="{{ url('/contact') }}" class="nav-link">Contact</a></li>

</ul>

</div>
</div>
</nav>

<section class="hero-wrap js-fullheight" style="background-image: url('{{ asset('images/home2.jpg') }}');">

<div class="overlay"></div>

<div class="container">

<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start">

<div class="col-md-7">

<h1 class="mb-4">Your journey begins with Om Shanti Travels.</h1>
<p style="font-size: 18px;">Om Shanti Travels provides premium car rental services for city tours, airport transfers, and outstation trips. Our goal is to make your travel safe, comfortable, and enjoyable</p>
                
</div>

</div>
</div>
</section>

     <section class="ftco-section ftco-no-pt bg-light">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-12	featured-top">
                    <!-- <div class="row no-gutters"> ... (Commented out section hidden for brevity) ... </div> -->
                <br>
<br>
<br>    
<div class="row no-gutters">
  <div class="col-md-4 d-flex align-items-center">
    <!-- Updated Form Class -->
    <form action="{{ route('contact.send') }}" method="POST" class="request-form ftco-animate modern-contact-form">

@csrf

<h2>Contact Us</h2>

<div class="form-group">
<label class="label">Full Name</label>
<input type="text" name="name" class="form-control" placeholder="Enter your name" required>
</div>

<div class="form-group">
<label class="label">Email</label>
<input type="email" name="email" class="form-control" placeholder="Enter your email" required>
</div>

<div class="form-group">
<label class="label">Subject</label>
<input type="text" name="subject" class="form-control" placeholder="Subject">
</div>

<div class="form-group">
<label class="label">Message</label>
<textarea name="message" class="form-control" rows="4" placeholder="Write your message"></textarea>
</div>

<div class="form-group">
<input type="submit" value="Send Message" class="btn btn-secondary py-3 px-4">
</div>

</form>
  </div>

  <div class="col-md-8 d-flex align-items-center">
    <div class="services-wrap rounded-right w-100">
      <h3 class="heading-section mb-4">Get In Touch With Om Shanti Travels</h3>

      <div class="row d-flex mb-4">

        <div class="col-md-4 d-flex align-self-stretch ftco-animate">
          <div class="services w-100 text-center">
            <div class="icon d-flex align-items-center justify-content-center">
              <span class="flaticon-route"></span>
            </div>
            <div class="text w-100">
              <h3 class="heading mb-2">Ask Us</h3>
              <p>Send your questions anytime.</p>
            </div>
          </div>
        </div>

        <div class="col-md-4 d-flex align-self-stretch ftco-animate">
          <div class="services w-100 text-center">
            <div class="icon d-flex align-items-center justify-content-center">
              <span class="flaticon-handshake"></span>
            </div>
            <div class="text w-100">
              <h3 class="heading mb-2">Friendly Support</h3>
              <p>Our team will help you quickly.</p>
            </div>
          </div>
        </div>

        <div class="col-md-4 d-flex align-self-stretch ftco-animate">
          <div class="services w-100 text-center">
            <div class="icon d-flex align-items-center justify-content-center">
              <span class="flaticon-rent"></span>
            </div>
            <div class="text w-100">
              <h3 class="heading mb-2">Quick Response</h3>
              <p>We reply as soon as possible.</p>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>


                </div>
          </div>
    </section>

<section class="ftco-section ftco-no-pt bg-light">
        <div class="container">
            <div class="row justify-content-center">
          <div class="col-md-12 heading-section text-center ftco-animate mb-5">
              <span class="subheading">What we offer</span>
            <h2 class="mb-2">Feeatured Vehicles</h2>
          </div>
        </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="carousel-car owl-carousel">
                        <div class="item">
                            <div class="car-wrap rounded ftco-animate">
            					<div class="img rounded d-flex align-items-end" style="background-image: url('{{ asset('images/swift.jpg') }}');">
            					</div>
            					<div class="text">
            						<h2 class="mb-0"><a href="#">Swift Dzire</a></h2>
            						<div class="d-flex mb-3">
                						<span class="cat">Maruti</span>
                					  <!-- <span>/day</span></p> -->
            						</div>
<p class="d-flex mb-0 d-block"><a href="{{ url('contact') }}" class="btn btn-primary py-2 mr-1">Contact Us</a>
              <a href="{{ url('car-single?id=1') }}" class="btn btn-secondary py-2 ml-1">Details</a></p>		    					</div>
            				</div>
                        </div>
                        <div class="item">
                            <div class="car-wrap rounded ftco-animate">
            					<div class="img rounded d-flex align-items-end" style="background-image: url('{{ asset('images/honda.jpg') }}');">
            					</div>
            					<div class="text">
            						<h2 class="mb-0"><a href="#">Honda City</a></h2>
            						<div class="d-flex mb-3">
                						<span class="cat">Honda</span>
                					  <!-- <span>/day</span></p> -->
            						</div>
<p class="d-flex mb-0 d-block"><a href="{{ url('contact') }}" class="btn btn-primary py-2 mr-1">Contact Us</a>
              <a href="{{ url('car-single?id=2') }}" class="btn btn-secondary py-2 ml-1">Details</a></p>		    					</div>
            				</div>
                        </div>
                        <div class="item">
                            <div class="car-wrap rounded ftco-animate">
            					<div class="img rounded d-flex align-items-end" style="background-image: url('{{ asset('images/amaze.jpg') }}');">
            					</div>
            					<div class="text">
            						<h2 class="mb-0"><a href="#">Honda Amaze</a></h2>
            						<div class="d-flex mb-3">
                						<span class="cat">Honda</span>
                					  <!-- <span>/day</span></p> -->
            						</div>
<p class="d-flex mb-0 d-block"><a href="{{ url('contact') }}" class="btn btn-primary py-2 mr-1">Contact Us</a>
              <a href="{{ url('car-single?id=3') }}" class="btn btn-secondary py-2 ml-1">Details</a></p>		    					</div>
            				</div>
                        </div>
                        <div class="item">
                            <div class="car-wrap rounded ftco-animate">
            					<div class="img rounded d-flex align-items-end" style="background-image: url('{{ asset('images/kia.jpg') }}');">
            					</div>
            					<div class="text">
            						<h2 class="mb-0"><a href="#">Kia Carens</a></h2>
            						<div class="d-flex mb-3">
                						<span class="cat">Kia</span>
                					  <!-- <span>/day</span></p> -->
            						</div>
<p class="d-flex mb-0 d-block"><a href="{{ url('contact') }}" class="btn btn-primary py-2 mr-1">Contact Us</a>
              <a href="{{ url('car-single?id=4') }}" class="btn btn-secondary py-2 ml-1">Details</a></p>		    					</div>
            				</div>
                        </div>
                    </div>


            
            

                </div>
            </div>
        </div>
</section>

<section class="ftco-section ftco-about">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url('{{ asset('images/b22.jpg') }}');">
                    </div>
                    <div class="col-md-6 wrap-about ftco-animate">
              <div class="heading-section heading-section-white pl-md-5">
              	<span class="subheading">About us</span>
                <h2 class="mb-4">Welcome to Om Shanti Travels</h2>

                <p>Om Shanti Travels has been a trusted travel service provider since 1989, offering reliable and comfortable travel solutions. With years of experience in the travel industry, we are committed to providing safe, convenient, and affordable journeys for our customers.</p>

                <p>Whether you need a car rental, city travel, or long-distance trip, our goal is to make every journey smooth and enjoyable.</p>
                <p>Let us show you the way — travel with us!</p>
                <p>Contact Us</p>   
                <p>📞 Mobile: +91 90990 35336 / 90999 82336 </p>
                <p>📧 Email: omshanti.amd@gmail.com</p>
                <p><a  href="{{ url('/about') }}" class="btn btn-primary py-3 px-4">Read More</a></p>
              </div>
            </div>
        </div>
    </div>
</section>

             <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
              <span class="subheading">Services</span>
            <h2 class="mb-3">Our Latest Services</h2>
          </div>
        </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="services services-2 w-100 text-center">
                <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-wedding-car"></span></div>
                <div class="text w-100">
                <h3 class="heading mb-2">🚗 Car Rental Services</h3>
                <p>Comfortable and well-maintained cars for local and outstation travel.</p>
              </div>
            </div>
                    </div>
                    <div class="col-md-3">
                        <div class="services services-2 w-100 text-center">
                <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-transportation"></span></div>
                <div class="text w-100">
                <h3 class="heading mb-2">✈️ Airport Transfers</h3>
                <p>Easy and reliable pick-up and drop services to and from the airport.</p>
              </div>
            </div>
                    </div>
                    <div class="col-md-3">
                        <div class="services services-2 w-100 text-center">
                <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-car"></span></div>
                <div class="text w-100">
                <h3 class="heading mb-2">🌍 Tour & Travel Assistance</h3>
                <p>Helping you plan trips with convenience and comfort.</p>
              </div>
            </div>
                    </div>
                    <div class="col-md-3">
                        <div class="services services-2 w-100 text-center">
                <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-transportation"></span></div>
                <div class="text w-100">
                <h3 class="heading mb-2">🛣️ Outstation Travel</h3>
                <p>Safe and affordable travel for long-distance journeys.</p>
              </div>
            </div>
                    </div>
                </div>
            </div>
        </section>
        
        
            <!-- <section class="ftco-section ftco-intro" style="background-image: url('{{ asset('images/bg_3.jpg') }}');"> ... </section> -->
        
        
        <!-- <section class="ftco-section testimony-section bg-light"> ... </section> -->
    
    
  <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 heading-section text-center ftco-animate">
              <span class="subheading">Blog</span>
            <h2>Recent Blog</h2>
          </div>
        </div>
        <div class="row d-flex">
          <div class="col-md-4 d-flex ftco-animate">
              <div class="blog-entry justify-content-end">
              <a href="blog.blade.php" class="block-20" style="background-image: url('{{ asset('images/image_1.jpg') }}');">
              </a>
              <div class="text pt-4">
                  <div class="meta mb-3">
                  <div><a href="#">Oct. 29, 2019</a></div>
                  <div><a href="#">Admin</a></div>
                  <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                </div>
                <h3 class="heading mt-2">
<a href="{{ url('/blog') }}">Top 5 Weekend Getaways from Ahmedabad for a Perfect Road Trip</a>
</h3>
                <p><a href="{{ url('/blog') }}" class="btn btn-primary">Read more</a></p>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex ftco-animate">
              <div class="blog-entry justify-content-end">
              <a href="blog.blade.php" class="block-20" style="background-image: url('{{ asset('images/b7.webp') }}');">
              </a>
              <div class="text pt-4">
                  <div class="meta mb-3">
                  <div><a href="#">Oct. 29, 2019</a></div>
                  <div><a href="#">Admin</a></div>
                  <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                </div>
                <h3 class="heading mt-2"><a href="{{ url('/blog') }}">5 Reasons Why Renting a Car is the Best Choice for Your Trip</a></h3>
                <p><a href="{{ url('/blog') }}" class="btn btn-primary">Read more</a></p>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex ftco-animate">
              <div class="blog-entry">
              <a href="blog.blade.php" class="block-20" style="background-image: url('{{ asset('images/b8.avif') }}');">
              </a>
              <div class="text pt-4">
                  <div class="meta mb-3">
                  <div><a href="#">Oct. 29, 2019</a></div>
                  <div><a href="#">Admin</a></div>
                  <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                </div>
                <h3 class="heading mt-2"><a href="{{ url('/blog') }}">10 Essential Travel Tips for a Safe and Comfortable Journey</a></h3>
                <p><a href="{{ url('/blog') }}" class="btn btn-primary">Read more</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>	

<section class="ftco-counter ftco-section img bg-light" id="section-counter">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                <div class="block-18">
                    <div class="text text-border d-flex align-items-center">
                        <strong class="number" data-number="40">0</strong>
                        <span>Years <br>Experience</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                <div class="block-18">
                    <div class="text text-border d-flex align-items-center">
                        <strong class="number" data-number="50">0</strong>
                        <span>Total <br>Cars</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                <div class="block-18">
                    <div class="text text-border d-flex align-items-center">
                        <strong class="number" data-number="8000">0</strong>
                        <span>Happy <br>Customers</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                <div class="block-18">
                    <div class="text d-flex align-items-center">
                        <strong class="number" data-number="12000">0</strong>
                        <span>Successful <br>Trips</span>
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
            <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
<li class="nav-item"><a href="{{ url('/about') }}" class="nav-link">About</a></li>
<li class="nav-item"><a href="{{ url('/cars') }}" class="nav-link">Cars</a></li>
<!-- <li class="nav-item"><a href="{{ url('/booking') }}" class="nav-link">Booking</a></li> -->
<li class="nav-item"><a href="{{ url('/blog') }}" class="nav-link">Blog</a></li>
<li class="nav-item"><a href="{{ url('/contact') }}" class="nav-link">Contact</a></li>
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