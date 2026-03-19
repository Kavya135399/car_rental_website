<!-- <h2>Reset Password</h2>

<form method="POST" action="/reset-password">
@csrf

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="New Password">

<input type="password" name="password_confirmation" placeholder="Confirm Password">

<button type="submit">Reset Password</button>

</form> -->
<!-- 
<h2>Reset Password</h2>

<form method="POST" action="/reset-password">
@csrf

<input type="hidden" name="email" value="{{ session('email') }}">

<input type="password" name="password" placeholder="New Password" required>

<input type="password" name="password_confirmation" placeholder="Confirm Password" required>

<button type="submit">Reset Password</button>

</form> -->

<form method="POST" action="/reset-password">
@csrf

<input type="password" name="password" placeholder="New Password" required>

<input type="password" name="password_confirmation" placeholder="Confirm Password" required>

<button type="submit">Reset Password</button>

</form>