<!-- <h2>Verify OTP</h2>

<form method="POST" action="/verify-otp">
@csrf

<input type="email" name="email" placeholder="Email" required>

<input type="text" name="otp" placeholder="Enter OTP">

<button type="submit">Verify OTP</button>

</form> -->

<h2>Verify OTP</h2>

@if(session('otp'))
<p style="color:green;">Your OTP: <b>{{ session('otp') }}</b></p>
@endif

@if(session('error'))
<p style="color:red;">{{ session('error') }}</p>
@endif

<form method="POST" action="/verify-otp">
@csrf

<input type="email" name="email" value="{{ session('email') }}" placeholder="Email">

<input type="text" name="otp" placeholder="Enter OTP">

<button type="submit">Verify OTP</button>

</form>