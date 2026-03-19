<h2>Forgot Password</h2>

@if(session('otp'))
<p>Your OTP: <b>{{ session('otp') }}</b></p>
@endif

<form method="POST" action="/send-otp">
@csrf

<input type="email" name="email" placeholder="Enter Email">

<button type="submit">Send OTP</button>

</form>