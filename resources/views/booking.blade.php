<!DOCTYPE html>
<html lang="en">
<head>
<title>Om Shanti Travels - Booking</title>

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

<style>
.booking-card{
    background:#fff;
    padding:40px;
    border-radius:10px;
    box-shadow:0 10px 30px rgba(0,0,0,0.1);
}
.booking-card h3{
    text-align:center;
    margin-bottom:30px;
    font-weight:600;
}
.form-control{
    height:48px;
    border-radius:6px;
}
textarea.form-control{
    height:auto;
}
.btn-book{
    background:#01d28e;
    border:none;
    padding:12px 35px;
    color:#fff;
    border-radius:30px;
    font-size:16px;
}
.btn-book:hover{
    background:#000;
    color:#fff;
}
</style>

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
<li class="nav-item"><a href="{{ url('/cars') }}" class="nav-link">Cars</a></li>
<!-- <li class="nav-item active"><a href="{{ url('/booking') }}" class="nav-link">Booking</a></li> -->
<li class="nav-item"><a href="{{ url('/blog') }}" class="nav-link">Blog</a></li>
<li class="nav-item"><a href="{{ url('/contact') }}" class="nav-link">Contact</a></li>
</ul>
</div>
</div>
</nav>

<!-- Hero -->
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('images/car-10.jpg') }}');">
<div class="overlay"></div>
<div class="container">
<div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
<div class="col-md-9 ftco-animate pb-5">
<p class="breadcrumbs">
<span class="mr-2"><a href="{{ url('/') }}">Home <i class="ion-ios-arrow-forward"></i></a></span>
<span>Booking <i class="ion-ios-arrow-forward"></i></span>
</p>
<h1 class="mb-3 bread">Book Your Ride</h1>
</div>
</div>
</div>
</section>

<!-- Booking Form -->
<section class="ftco-section bg-light">
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="booking-card">

<h3>Car Booking Form</h3>
@if ($errors->any())
<div class="alert alert-danger">
    <strong>⚠ Please fix the following errors:</strong>
    <ul style="margin-top:10px;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form action="{{ url('/booking') }}" method="POST" enctype="multipart/form-data">

@csrf
<div class="row">

<!-- Selected Car -->
<div class="col-md-6">
<label>Selected Car</label>
<input type="text" name="car" value="{{ request('car') }}" class="form-control" readonly>
<input type="hidden" name="car_id" value="{{ request('car_id') }}">
</div>

<div class="col-md-6">
<label>Price Per Day</label>
<input type="text" name="price_per_day" id="price_per_day" value="{{ request('price') }}" class="form-control" readonly>
</div>

<div class="col-md-6">
<label>Car Seats</label>
<input type="number" id="car_seats" value="{{ request('seats') }}" class="form-control" readonly>
</div>

<div class="col-md-12">
<p id="carSuggestion" style="color:red;font-weight:500;"></p>
</div>
<div class="col-md-6">
<label>Your Name</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="col-md-6">
<label>Phone Number</label>
<input type="text" name="phone" class="form-control" required>
</div>

<div class="col-md-6">
<label>Email</label>
<input type="email" name="email" class="form-control">
</div>

<!-- Number of Passengers -->
<div class="col-md-6">
<label>Number of Passengers</label>
<input type="number" name="passengers" class="form-control" min="1" required>
</div>

<div class="col-md-6">
<label>Pickup Location</label>
<input type="text" name="pickup" class="form-control">
</div>

<div class="col-md-6">
<label>Drop Location</label>
<input type="text" name="drop" class="form-control">
</div>

<!-- Pickup Date -->
<div class="col-md-6">
<label>Pickup Date</label>
<input type="date" name="date" class="form-control" required min="{{ date('Y-m-d') }}">
</div>

<!-- Pickup Time -->
<div class="col-md-6">
<label>Pickup Time</label>
<input type="time" name="pickup_time" class="form-control" required>
</div>

<!-- Return Date -->
<div class="col-md-6">
<label>Return Date</label>
<input type="date" name="return_date" class="form-control">
</div>

<!-- Drop Time -->
<div class="col-md-6">
<label>Drop Time</label>
<input type="time" name="drop_time" class="form-control">
</div>
<!-- Price Per Day -->
<!-- <div class="col-md-6">
<label>Price Per Day (₹)</label>
<input type="number" name="price_per_day" id="price_per_day" class="form-control" value="1500" readonly>
</div> -->

<!-- Total Days -->
<div class="col-md-6">
<label>Total Days</label>
<input type="number" name="total_days" id="total_days" class="form-control" readonly>
</div>

<!-- Total Amount -->
<div class="col-md-6">
<label>Total Amount (₹)</label>
<input type="number" name="total_amount" id="total_amount" class="form-control" readonly>
</div>



<div class="col-md-6">
  <label>Advance Payment (₹)</label>
  <input type="number" id="advance_amount" class="form-control" readonly>
</div>
<input type="hidden" name="amount_paid" id="amount_paid" value="0">


<!-- Payment Method -->
<div class="col-md-6">
<div class="form-group">
<label>Payment Method</label>
<select name="payment_method" id="payment_method" class="form-control">
<option value="">Select Payment Method</option>
<option value="Cash">Cash</option>
<option value="UPI">UPI</option>
<option value="Online">Online</option>
</select>
</div>
</div>

<!-- UPI Payment Section -->
<div class="col-md-12 text-center" id="upi_section" style="display:none;">
<label>Scan & Pay</label><br>

<img src="{{ asset('images/upi-qr1.jpeg') }}" width="200">

<p class="mt-2">
UPI ID : <strong>davekavya43@oksbi</strong>
</p>

<p style="color:green;">
After payment enter UTR ID below
</p>
</div>

<!-- Online Payment Section (auto verification via gateway) -->
<div class="col-md-12" id="online_section" style="display:none;">
  <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:12px;padding:12px;">
    <div style="font-weight:800;">Online Payment</div>
    <div style="color:#1f2937;margin-top:6px;">You will be redirected to secure checkout after booking submit. Payment will be verified automatically.</div>
  </div>
</div>

<!-- UTR Input (only user input for UPI proof) -->
<div class="col-md-12" id="payment_utr_section" style="display:none;">
<label>UTR ID (Transaction ID)</label>
<input type="text" name="payment_utr" id="payment_utr" class="form-control" placeholder="Enter UTR ID" autocomplete="off">
<small style="color:#6b7280;">Example: 123456789012 (from your UPI app payment details)</small>
</div>

<!-- Online payment terms acceptance (required for UPI/Online) -->
<div class="col-md-12" id="online_terms_section" style="display:none;margin-top:10px;">
  <div style="background:#f8fafc;border:1px solid #e5e7eb;border-radius:12px;padding:12px;">
    <label style="display:flex;gap:10px;align-items:flex-start;margin:0;">
      <input type="checkbox" name="online_payment_terms" id="online_payment_terms" value="1">
      <span>
        I agree to the
        <a href="{{ url('/terms/online-payment') }}" target="_blank" rel="noopener">Online Payment Terms & Conditions</a>.
      </span>
    </label>
    <small style="color:#6b7280;">Required for UPI/Online payments.</small>
  </div>
</div>
<!-- Message -->
<div class="col-md-12">
<label>Message</label>
<textarea name="message" class="form-control" rows="3"></textarea>
</div>

<div class="col-md-12 text-center mt-4">
<p id="availabilityMsg" style="display:none;color:#dc2626;font-weight:700;margin-bottom:10px;"></p>
<button type="submit" class="btn-book" id="confirmBookingBtn">Confirm Booking</button>
</div>

</div>
</form>

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
<script src="{{ asset('js/booking-availability.js') }}"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    let paymentMethod = document.getElementById("payment_method");
    let upiSection = document.getElementById("upi_section");
    let onlineSection = document.getElementById("online_section");
    let utrSection = document.getElementById("payment_utr_section");
    let utrInput = document.getElementById("payment_utr");
    let termsSection = document.getElementById("online_terms_section");
    let termsCheckbox = document.getElementById("online_payment_terms");

    paymentMethod.addEventListener("change", function(){

        if(this.value === "UPI"){
            upiSection.style.display = "block";
            utrSection.style.display = "block";
            utrInput.required = true;
            termsSection.style.display = "block";
            termsCheckbox.required = true;
            onlineSection.style.display = "none";
        }else if(this.value === "Online"){
            upiSection.style.display = "none";
            utrSection.style.display = "none";
            utrInput.required = false;
            utrInput.value = "";
            onlineSection.style.display = "block";
            termsSection.style.display = "block";
            termsCheckbox.required = true;
        }else{
            upiSection.style.display = "none";
            utrSection.style.display = "none";
            utrInput.required = false;
            utrInput.value = "";
            onlineSection.style.display = "none";
            termsSection.style.display = "none";
            termsCheckbox.required = false;
            termsCheckbox.checked = false;
        }

    });

});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {

let pickupDate = document.querySelector("input[name='date']");
let returnDate = document.querySelector("input[name='return_date']");
let pickupTime = document.querySelector("input[name='pickup_time']");
let dropTime = document.querySelector("input[name='drop_time']");
let price = document.getElementById("price_per_day");
let totalDays = document.getElementById("total_days");
let totalAmount = document.getElementById("total_amount");
let advanceAmount = document.getElementById("advance_amount");
let amountPaid = document.getElementById("amount_paid");

// ✅ ADD THESE (missing in your code)
let paymentMethod = document.getElementById("payment_method");

// ✅ Calculate function
function calculateAmount(){

    if(pickupDate.value && returnDate.value){

        let start = new Date(pickupDate.value + "T00:00:00");
        let end = new Date(returnDate.value + "T00:00:00");

        if(end >= start){

            let diffTime = end.getTime() - start.getTime();

            let days = Math.floor(diffTime / (1000 * 60 * 60 * 24)) + 1;

            totalDays.value = days;

            let amount = days * parseFloat(price.value || 0);
            totalAmount.value = amount;

            // ✅ AUTO UPDATE ADVANCE
            if(paymentMethod.value === "UPI" || paymentMethod.value === "Online"){
                advanceAmount.value = amount * 0.5;
            } else {
                advanceAmount.value = 0;
            }

            amountPaid.value = advanceAmount.value || 0;
        }
    }

    if(method === "Online"){
        if(terms && !terms.checked){
            alert("âš  Please accept the Online Payment Terms & Conditions to continue.");
            e.preventDefault();
            return;
        }
    }
}

// trigger events
pickupDate.addEventListener("change", calculateAmount);
returnDate.addEventListener("change", calculateAmount);

// auto set return date
pickupDate.addEventListener("change", function(){
    returnDate.value = pickupDate.value;
});

// default drop time = pickup time (helps keep a valid range)
pickupTime.addEventListener("change", function(){
    if (!dropTime.value) dropTime.value = pickupTime.value;
});

// ✅ UPDATE ADVANCE WHEN PAYMENT METHOD CHANGES
paymentMethod.addEventListener("change", function(){

    let total = parseFloat(totalAmount.value || 0);

    if(this.value === "UPI" || this.value === "Online"){
        advanceAmount.value = total * 0.5;
    } else {
        advanceAmount.value = 0;
    }

    amountPaid.value = advanceAmount.value || 0;

});

});
</script>
<script>
document.addEventListener("DOMContentLoaded", function(){

let passengers = document.querySelector("input[name='passengers']");
let seats = document.getElementById("car_seats");
let suggestion = document.getElementById("carSuggestion");

passengers.addEventListener("input", function(){

let passengerCount = parseInt(this.value) || 0;
let carSeats = parseInt(seats.value) || 0;

if(passengerCount > carSeats){
    suggestion.innerHTML =
    "⚠ This car has only " + carSeats +
    " seats. Please choose a bigger car.";
}
else if(passengerCount <= 4){
    suggestion.innerHTML =
    "💡 Suggested: 4 Seater (Swift Dzire, Honda City, Amaze)";
}
else{
    suggestion.innerHTML =
    "💡 Suggested: 6 Seater (Innova Crysta, Kia Carens, Toyota Fortuner,Invicto)";
}

});

});
</script>
<script>
document.querySelector("form").addEventListener("submit", function(e){

    let method = document.getElementById("payment_method").value;
    let utrInput = document.querySelector("input[name='payment_utr']");
    let utr = (utrInput?.value || "").trim();
    let terms = document.getElementById("online_payment_terms");

    if(method === "UPI"){

        if(!utr){
            alert("⚠ Please enter UTR ID after payment!");
            e.preventDefault();
            return;
        }
        if(!/^[A-Za-z0-9]{6,64}$/.test(utr)){
            alert("⚠ Invalid UTR ID. Please enter only letters/numbers (6-64 characters).");
            e.preventDefault();
            return;
        }

        if(terms && !terms.checked){
            alert("âš  Please accept the Online Payment Terms & Conditions to continue.");
            e.preventDefault();
            return;
        }

    }

});
</script>
</body>
</html>
