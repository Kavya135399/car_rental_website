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
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light">
<div class="container">

<a class="navbar-brand" href="{{ url('/') }}">Om Shanti <span>Travels</span></a>

<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav">
<span class="oi oi-menu"></span> Menu
</button>

<div class="collapse navbar-collapse" id="ftco-nav">

<ul class="navbar-nav ml-auto">

<li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
<li class="nav-item"><a href="{{ url('/about') }}" class="nav-link">About</a></li>
<li class="nav-item"><a href="{{ url('/cars') }}" class="nav-link">Cars</a></li>
<!-- <li class="nav-item"><a href="{{ url('/booking') }}" class="nav-link">Booking</a></li> -->
<li class="nav-item"><a href="{{ url('/blog') }}" class="nav-link">Blog</a></li>
<li class="nav-item"><a href="{{ url('/contact') }}" class="nav-link">Contact</a></li>

</ul>

</div>
</div>
</nav>


<section class="hero-wrap js-fullheight" style="background-image: url('{{ asset('images/bg_1.jpg') }}');">

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
    				<!-- <div class="row no-gutters">
	  					<div class="col-md-4 d-flex align-items-center">
	  						<form action="#" class="request-form ftco-animate bg-primary">
		          		<h2>Make your trip</h2>
			    				<div class="form-group">
			    					<label for="" class="label">Pick-up location</label>
			    					<input type="text" class="form-control" placeholder="City, Airport, Station, etc">
			    				</div>
			    				<div class="form-group">
			    					<label for="" class="label">Drop-off location</label>
			    					<input type="text" class="form-control" placeholder="City, Airport, Station, etc">
			    				</div>
			    				<div class="d-flex">
			    					<div class="form-group mr-2">
			                <label for="" class="label">Pick-up date</label>
			                <input type="text" class="form-control" id="book_pick_date" placeholder="Date">
			              </div>
			              <div class="form-group ml-2">
			                <label for="" class="label">Drop-off date</label>
			                <input type="text" class="form-control" id="book_off_date" placeholder="Date">
			              </div>
		              </div>
		              <div class="form-group">
		                <label for="" class="label">Pick-up time</label>
		                <input type="text" class="form-control" id="time_pick" placeholder="Time">
		              </div>
			            <div class="form-group">
			              <input type="submit" value="Rent A Car Now" class="btn btn-secondary py-3 px-4">
			            </div>
			    			</form>
	  					</div>
	  					<div class="col-md-8 d-flex align-items-center">
	  						<div class="services-wrap rounded-right w-100">
	  							<h3 class="heading-section mb-4">Better Way to Rent Your Perfect Cars</h3>
	  							<div class="row d-flex mb-4">
					          <div class="col-md-4 d-flex align-self-stretch ftco-animate">
					            <div class="services w-100 text-center">
				              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
				              	<div class="text w-100">
					                <h3 class="heading mb-2">Contact Us</h3>
				                </div>
					            </div>      
					          </div>
					          <div class="col-md-4 d-flex align-self-stretch ftco-animate">
					            <div class="services w-100 text-center">
				              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-handshake"></span></div>
				              	<div class="text w-100">
					                <h3 class="heading mb-2">Select the Best Deal</h3>
					              </div>
					            </div>      
					          </div>
					          <div class="col-md-4 d-flex align-self-stretch ftco-animate">
					            <div class="services w-100 text-center">
				              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-rent"></span></div>
				              	<div class="text w-100">
					                <h3 class="heading mb-2">Reserve Your Rental Car</h3>
					              </div>
					            </div>      
					          </div>
					        </div>
					        <p><a href="#" class="btn btn-primary py-3 px-4">Reserve Your Perfect Car</a></p>
	  						</div>
	  					</div>
	  				</div> -->
                <br>
<br>
<br>    
<div class="row no-gutters">
  <div class="col-md-4 d-flex align-items-center">
    <form action="{{ route('contact.send') }}" method="POST" class="request-form ftco-animate bg-primary">

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

<!-- <div class="form-group">
<label class="label">Phone Number</label>
<input type="text" name="phone" class="form-control" placeholder="Enter phone number" required>
</div> -->

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
		    					<div class="img rounded d-flex align-items-end" style="background-image: url(images/swift.jpg);">
		    					</div>
		    					<div class="text">
		    						<h2 class="mb-0"><a href="#">Swift Dzire</a></h2>
		    						<div class="d-flex mb-3">
			    						<span class="cat">Maruti</span>
			    					  <!-- <span>/day</span></p> -->
		    						</div>
<p class="d-flex mb-0 d-block"><a href="{{ url('booking?car=Swift Dzire&price=3000&seats=4') }}" class="btn btn-primary py-2 mr-1">Book Now</a>
              <a href="{{ url('car-single?id=1') }}" class="btn btn-secondary py-2 ml-1">Details</a></p>		    					</div>
		    				</div>
    					</div>
    					<div class="item">
    						<div class="car-wrap rounded ftco-animate">
		    					<div class="img rounded d-flex align-items-end" style="background-image: url(images/honda.jpg);">
		    					</div>
		    					<div class="text">
		    						<h2 class="mb-0"><a href="#">Honda City</a></h2>
		    						<div class="d-flex mb-3">
			    						<span class="cat">Honda</span>
			    					  <!-- <span>/day</span></p> -->
		    						</div>
<p class="d-flex mb-0 d-block"><a href="{{ url('booking?car=Honda City&price=3000&seats=4') }}" class="btn btn-primary py-2 mr-1">Book Now</a>
              <a href="{{ url('car-single?id=2') }}" class="btn btn-secondary py-2 ml-1">Details</a></p>		    					</div>
		    				</div>
    					</div>
    					<div class="item">
    						<div class="car-wrap rounded ftco-animate">
		    					<div class="img rounded d-flex align-items-end" style="background-image: url(images/amaze.jpg);">
		    					</div>
		    					<div class="text">
		    						<h2 class="mb-0"><a href="#">Honda Amaze</a></h2>
		    						<div class="d-flex mb-3">
			    						<span class="cat">Honda</span>
			    					  <!-- <span>/day</span></p> -->
		    						</div>
<p class="d-flex mb-0 d-block"><a href="{{ url('booking?car=Honda Amaze&price=3000&seats=4') }}" class="btn btn-primary py-2 mr-1">Book Now</a>
              <a href="{{ url('car-single?id=3') }}" class="btn btn-secondary py-2 ml-1">Details</a></p>		    					</div>
		    				</div>
    					</div>
    					<div class="item">
    						<div class="car-wrap rounded ftco-animate">
		    					<div class="img rounded d-flex align-items-end" style="background-image: url(images/kia.jpg);">
		    					</div>
		    					<div class="text">
		    						<h2 class="mb-0"><a href="#">Kia Carens</a></h2>
		    						<div class="d-flex mb-3">
			    						<span class="cat">Kia</span>
			    					  <!-- <span>/day</span></p> -->
		    						</div>
<p class="d-flex mb-0 d-block"><a href="{{ url('booking?car=Kia Carens&price=5500&seats=6') }}" class="btn btn-primary py-2 mr-1">Book Now</a>
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
					<div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url(images/about.jpg);">
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
        
        
    		<!-- <section class="ftco-section ftco-intro" style="background-image: url(images/bg_3.jpg);">
			<div class="overlay"></div>
			<div class="container">
				<div class="row justify-content-end">
					<div class="col-md-6 heading-section heading-section-white ftco-animate">
            <h2 class="mb-3">Do You Want To Earn With Us? So Don't Be Late.</h2>
            <a href="#" class="btn btn-primary btn-lg">Become A Driver</a>
          </div>
				</div>
			</div>
		</section> -->
        
        
        <!-- <section class="ftco-section testimony-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
          	<span class="subheading">Testimonial</span>
            <h2 class="mb-3">Happy Clients</h2>
          </div>
        </div>
        <div class="row ftco-animate">
          <div class="col-md-12">
            <div class="carousel-testimony owl-carousel ftco-owl">
              <div class="item">
                <div class="testimony-wrap rounded text-center py-4 pb-5">
                  <div class="user-img mb-2" style="background-image: url(images/person_1.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Roger Scott</p>
                    <span class="position">Marketing Manager</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap rounded text-center py-4 pb-5">
                  <div class="user-img mb-2" style="background-image: url(images/person_2.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Roger Scott</p>
                    <span class="position">Interface Designer</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap rounded text-center py-4 pb-5">
                  <div class="user-img mb-2" style="background-image: url(images/person_3.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Roger Scott</p>
                    <span class="position">UI Designer</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap rounded text-center py-4 pb-5">
                  <div class="user-img mb-2" style="background-image: url(images/person_1.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Roger Scott</p>
                    <span class="position">Web Developer</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap rounded text-center py-4 pb-5">
                  <div class="user-img mb-2" style="background-image: url(images/person_1.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Roger Scott</p>
                    <span class="position">System Analyst</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->
    
    
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
              <a href="blog.blade.php" class="block-20" style="background-image: url('images/image_1.jpg');">
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
              <a href="blog.blade.php" class="block-20" style="background-image: url('images/home.jpg');">
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
              <a href="blog.blade.php" class="block-20" style="background-image: url('images/image_3.jpg');">
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
						<strong class="number" data-number="30">0</strong>
						<span>Years <br>Experience</span>
					</div>
				</div>
			</div>

			<div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
				<div class="block-18">
					<div class="text text-border d-flex align-items-center">
						<strong class="number" data-number="20">0</strong>
						<span>Total <br>Cars</span>
					</div>
				</div>
			</div>

			<div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
				<div class="block-18">
					<div class="text text-border d-flex align-items-center">
						<strong class="number" data-number="800">0</strong>
						<span>Happy <br>Customers</span>
					</div>
				</div>
			</div>

			<div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
				<div class="block-18">
					<div class="text d-flex align-items-center">
						<strong class="number" data-number="1200">0</strong>
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